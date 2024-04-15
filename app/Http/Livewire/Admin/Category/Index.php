<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $categories;
    // public $categories ;
    public $name, $products;
    public $selectedCategory;

    
    public function render()
    {
        
        $categories = Category::paginate(5);
        // dd($categories);
        return view('livewire.admin.category.index', compact('categories'));
        
    }
    // public function render()
    // {
        
    //     $this->categories = Category::all();
    //     $categories = Category::paginate(5);

    //     return view('livewire.admin.category.index', [
    //         'categories' => $categories,
    //     ]);
    // }
    
    // public function mount()
    // {
    //     $this->categories = Category::all();
        
    //     // $this->products = Product::all();
    // }


    public function create()
    {
        # code...
        $validatedData = $this->validate([
            'name' => 'required|unique:categories,category_name',
        ], [
            'name.required' => 'Please enter a category name.',
            'name.unique' => 'This category name already exists.',
        ]);

        Category::create(['category_name' => $this->name]);
        $this->reset('name');
        $this->categories = Category::all();
        
        // $this->emit('categoryCreated');
        // session()->flash('message', 'Category created successfully!');
        toastr()->success('Data has been saved successfully!', 'Congrats',['timeOut' => 3500]);
    
    }

    // public function edit($id)
    // {
    //     $category = Category::find($id);
    //     $this->selectedCategory = $category;
    //     $this->name = $category->category_name;
        
    // }

    // public function update()
    // {
    //     $this->selectedCategory->update(['category_name' => $this->name]);
    //     $this->reset('name', 'selectedCategory');
    //     $this->categories = Category::all();
    //     $this->reset(['selectedCategory', 'name']);
    //     // session()->flash('message', 'Category Update successfully!');
    //     toastr()->success('Data has been updated!', 'Congrats',['timeOut' => 3500]);
    // }
    public function update()
    {
        // Make sure $this->modalId is set before calling update
        if ($this->modalId) {
            $category = Category::find($this->modalId);
            
            if ($category) {
                $category->update(['category_name' => $this->name]);
                $this->categories = Category::all();
                $this->reset('name');
                toastr()->success('Data has been updated!', 'Congrats',['timeOut' => 3500]);
                $this->closeModalUpdate();
            }
        }
    }


    
    public function delete($id)
    {

        Category::destroy($id);
        $this->categories = Category::all();
        toastr()->success('Data has been deleted!', 'Congrats',['timeOut' => 3500]);
        $this->closeModalDelete();
    }

    public $showModalDelete = false;
    public $showModalUpdate = false;
    public $modalId;
    public $categoryName;
    // Function to open the modal with a specific ID
    public function showModalDelete($id, $categoryName)
    {
        $this->modalId = $id; 
        $this->categoryName = $categoryName;
        $this->showModalDelete = true;
    }
    public function showModalUpdate($id, $categoryName)
    {
        $this->modalId = $id; 
        $this->name = $categoryName;
        $this->showModalUpdate = true;
        // dd($this->name);
    }

    // Function to close the modal
    public function closeModalDelete()
    {
        $this->showModalDelete = false;
    }
    public function closeModalUpdate()
    {
        $this->showModalUpdate = false;
        $this->reset('name');
    }


}
