<?php

namespace App\Http\Livewire\Admin\Product;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $products;
    public $searchTerm = '';
    public  $category_id, $categories, $selectedProduct, $updateSelectedProduct;
    public $image,$name, $price, $description,  $stock, $weight;
    // public $images,$name, $price, $description,  $stock =[] ;
    

    public function render()
    {
        // search system
        $products = Product::with('images')
                    ->when($this->searchTerm, function ($query) {
                        $query->where('name', 'like', '%'.$this->searchTerm.'%')
                              ->orWhere('description', 'like', '%'.$this->searchTerm.'%');
                    })
                    ->paginate(5);

        $this->categories = Category::all();
        return view('livewire.admin.product.index', compact('products'));
        
        // $products = Product::with('images')->paginate(5);
        // $this->categories = Category::all();
        
        // return view('livewire.admin.product.index', compact('products'));
    }
    



    public function store()
    {
        // Validate the incoming data
        $validatedData = $this->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'description' => 'required|string',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'exists:categories,id',
            'stock' => 'required|numeric',
        ]);
    
        // Create a new product record in the database
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'stock' => $validatedData['stock'],
        ]);
    
        // Check how many images this product already has
        $existingImagesCount = $product->images()->count();
    
        // Process uploaded images
        if (!empty($this->image)) {
            foreach ($this->image as $key => $image) {
                $existingImagesCount++;
                // Format the image name using product name and the image count
                $imageName = $product->name . '-' . $existingImagesCount . '.' . $image->getClientOriginalExtension();
                
                // Store the image with the formatted name
                $imagePath = $image->storeAs('products', $imageName, 'public');
                
                // Create a new product image record in the database
                $product->images()->create([
                    'image_url' => $imagePath,
                ]);
            }
        }
    
        // Reset form fields and fetch updated product and category data
        $this->reset();
        $this->image = null;
        $this->dispatchBrowserEvent('clearFileInput');
        $this->products = Product::all();
        $this->categories = Category::all();
        
        // Show success message
        toastr()->success('Data has been saved successfully!', 'Congrats',['timeOut' => 3500]);
    }
    


    // public function edit($id)
    // {
        
    //     $product = Product::find($id);
    //     $this->selectedProduct = $product;
    //     $this->name = $product->name;
    //     $this->price = $product->price;
    //     $this->description = $product->description;
    //     $this->image = $product->image;
    //     $this->stock = $product->stock;
    //     $this->category_id = $product->category_id;
        
    // }




    // public function update()
    // {

    //     $validatedData = $this->validate([
    //         'name'=>'required|string',
    //         'price' => 'required|numeric',
    //         'description' => 'required',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'category_id' => 'exists:categories,id',
    //         'stock' => 'required|numeric',
    //     ]);
    //     if ($this->image != null) {
    //         $validatedData['image'] = $this->image->store('products');
        
    //     }
    //     $this->selectedProduct->update($validatedData,[
    //         'name' => $this->name,
    //         'price'=>$this->price,
    //         'description'=>$this->description,
    //         'stock'=>$this->stock,
    //         'category_id'=>$this->category_id,
    //         'image'=>$this->image
    //     ]);


    //     $this->reset('name','price','description','stock','image','category_id', 'selectedProduct');
    //     $this->products = Product::all();
    //     $this->reset(['name','price','description','stock','image','category_id', 'selectedProduct']);
    //     session()->flash('message', 'Product Update successfully!');
    // }
    public function updateProduct($id)
    {
        $products = Product::find($id);

        if ($products) {
            $this->updateSelectedProduct = $products;
        }
    }

    // old delete
    public function delete($id)
    {
        Product::destroy($id);
        $this->products = Product::all();
        toastr()->success('Data has been deleted!',['timeOut' => 3500]);
        
    }

    // new delete
    public $showDeleteModal = false;
    public $deletingProductId = null;

    public function showDeleteModal($productId)
    {
        $this->deletingProductId = $productId;
        $this->showDeleteModal = true;
    }

    public function deleteProduct()
    {
        $product = Product::find($this->deletingProductId);
        if ($product) {
            $product->delete();
            $this->showDeleteModal = false; // Close the modal on successful deletion
            toastr()->success('Data has been deleted!',['timeOut' => 3500]);
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
    }



    
    public function getProduct($id)
    {
        $products = Product::find($id);

        if ($products) {
            $this->selectedProduct = $products;
        }
        
    }

    public $showDropdown = false;
    public $showModalAdd = false;
    // public $showModalDelete = false;
   
    public $dropdownId;
    
    
    public function showDropdown($id)
    {
      
        $this->dropdownId = $this->dropdownId === $id ? null : $id;
    }
    
    public function closeDropdown()
    {
        $this->dropdownId = null;
    }
    

    public function showModalAdd()
    {
        $this->image = null;   
        $this->showModalAdd = true;
    }
    
   
    // Function to close the modal
    public function closeModalAdd()
    {
        $this->showModalAdd = false;
        $this->image = null;
    }
   

}
