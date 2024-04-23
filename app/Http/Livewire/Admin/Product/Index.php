<?php

namespace App\Http\Livewire\Admin\Product;

use Carbon\Carbon;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $products;
    public  $category_id, $categories, $selectedProduct;
    public $image,$name, $price, $description,  $stock;
    // public $images,$name, $price, $description,  $stock =[] ;
    

    public function render()
    {
        $products = Product::paginate(10);
        $this->categories = Category::all();
        // dd($categories);
        return view('livewire.admin.product.index', compact('products'));
    }
    

    // public function mount() 
    // {
    //     $this->products = Product::all();
    //     $this->categories = Category::all();
    // }

    // protected $rules = [
    //     // 'name' => 'required|unique:products,name',
    //     'name'=>'required|string',
    //     'price' => 'required|numeric',
    //     'description' => 'required',
    //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     'category_id' => 'exists:categories,id',
    //     'stock' => 'required|numeric',
    // ];

    // public function store()
    // {
       
    //     $validatedData = $this->validate();

    //     $validatedData['image'] = $this->image->store('products', 'public');
        
    //     Product::create($validatedData);
    //     $this->reset();
    //     $this->products = Product::all();
    //     $this->categories = Category::all();
    //     session()->flash('message', 'Product created successfully!');

       
    // }

    public function store()
    {
        // Validate the incoming data
        $validatedData = $this->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'exists:categories,id',
            'stock' => 'required|numeric',
        ]);


        // Create a new product record in the database
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'stock' => $validatedData['stock'],
        ]);

        // Create a new product image record in the database
        if (!empty($this->image)) {
            // Process uploaded images
            foreach ($this->image as $key => $image) {
                // Validate and store the image in the storage folder
                $imagePath = $image->store('products', 'public');
                
                // Create a new product image record in the database
                $product->images()->create([
                    'image_url' => $imagePath,
                ]);
            }
        }
        

        // Reset form fields and fetch updated product and category data
        $this->reset();
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

    
    public function delete($id)
    {
        Product::destroy($id);
        $this->products = Product::all();
        $this->showModalDelete = false;
        toastr()->success('Data has been deleted!',['timeOut' => 3500]);
        
    }


    public $showDropdown = false;
    public $showModalAdd = false;
    public $showModalDelete = false;
    public $showModalUpdate = false;
    public $showModalPreview = false;
    public $modalId,$deleteId, $showProduct, $dropdownId;
    
    
    public function showDropdown($id)
    {
        $this->dropdownId = $id;
        $this->showDropdown = true;
        $this->dispatchBrowserEvent('show-dropdown', ['id' => $id]);
    }

    public function closeDropdown()
    {
        
        $this->showDropdown = false;
    }

    public function showModalAdd()
    {
        
        $this->showModalAdd = true;
    }
    
    public function showModalDelete($id)
    {
        $this->deleteId = $id; 
        
        $this->showModalDelete = true;
    }
    // public function showModalUpdate($id, $categoryName)
    // {
    //     $this->modalId = $id; 
    //     $this->name = $categoryName;
    //     $this->showModalUpdate = true;
    //     // dd($this->name);
    // }
    public $previewName, $previewPrice, $previewDescription, $previewImage, $previewStock, $previewCategory ;
    public function showModalPreview($id)
    {
        $this->closeModalAdd();
        $this->closeModalDelete();
        // dd($id);
        $this->modalId = $id; 
        $this->showModalPreview = true;
            
        $showProduct = Product::find($id);
        $this->previewName = $showProduct->name;
        $this->previewPrice = $showProduct->price;
        $this->previewDescription = $showProduct->description;
        $this->previewImage = $showProduct->image;
        $this->previewStock = $showProduct->stock;
        $this->previewCategory = $showProduct->category->category_name;
    }


    // Function to close the modal
    public function closeModalAdd()
    {
        $this->showModalAdd = false;
    }
    public function closeModalDelete()
    {
        $this->showModalDelete = false;
    }
    public function closeModalUpdate()
    {
        $this->showModalUpdate = false;
        $this->reset('name');
    }
    public function closeModalPreview()
    {
        $this->showModalPreview = false;
         $this->products = Product::all();
        $this->categories = Category::all();
    }

    // pagiantion refresh page
    public function updatedPage($page)
    {
        $this->emit('pageChanged', $page);
        
    }
  


}
