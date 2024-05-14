<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Productimage;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class Edit extends Component
{
    use WithFileUploads;
    protected $products;
    public $updateSelectedProduct, $category_id, $categories, $image;
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.admin.product.edit',[
            'updateSelectedProduct' => $this->updateSelectedProduct,
            'products' => $this->products,
        ]);
    }

    protected $rules = [
        'updateSelectedProduct.name' => 'required|string|max:255',
        'updateSelectedProduct.stock' => 'required|numeric|min:0',
        'updateSelectedProduct.price' => 'required|numeric',
        'updateSelectedProduct.description' => 'required|string|max:5000',
        'updateSelectedProduct.category_id' => 'required|exists:categories,id',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        // Add other fields as necessary
    ];  

    public $imagesToDelete = [];

    public function markForDeletion($imageId)
    {
        if (!in_array($imageId, $this->imagesToDelete)) {
            $this->imagesToDelete[] = $imageId;
        } else {
            // Optionally remove the image from deletion list if clicked again
            $this->imagesToDelete = array_diff($this->imagesToDelete, [$imageId]);
        }
    }
    public function confirmDeleteImages()
    {
        $this->dispatchBrowserEvent('confirm-delete', ['images' => $this->imagesToDelete]);
    }


    private function handleImageDeletion()
    {
        if (!empty($this->imagesToDelete)) {
            foreach ($this->imagesToDelete as $imageId) {
                $productImage = ProductImage::find($imageId);
                if ($productImage) {
                    $productImage->delete();
                }
            }
            $this->imagesToDelete = []; // Clear the deletion list after processing
        }
    }


    public function updateProductInfo()
    {
        $this->validate();

        try {
            $product = Product::find($this->updateSelectedProduct->id);
            if ($product) {
                $product->name = $this->updateSelectedProduct->name;
                $product->stock = $this->updateSelectedProduct->stock;
                $product->price = $this->updateSelectedProduct->price;
                $product->description = $this->updateSelectedProduct->description;
                $product->category_id = $this->updateSelectedProduct->category_id;

                $newImages = !empty($this->image);
                $imagesToDelete = !empty($this->imagesToDelete);

                // Check if any properties were changed, new images added, or images marked for deletion
                if ($product->isDirty() || $newImages || $imagesToDelete) {
                    $product->save();
                    toastr()->success('Product updated successfully!', 'Congrats', ['timeOut' => 3500]);

                    if ($newImages) {
                        $this->handleImageUpload($product);
                    }

                    // Handle image deletion if images have been marked for deletion
                    if ($imagesToDelete) {
                        $this->handleImageDeletion();
                        // $this->image = null;
                    }

                    $this->BackTo();
                } else {
                    toastr()->info('No changes detected to save.', 'Info', ['timeOut' => 3500]);
                }
            }
        } catch (\Exception $e) {
            toastr()->error('Failed to update product: ' . $e->getMessage(), 'Error', ['timeOut' => 3500]);
        }
    }

    // dont touch
    private function handleImageUpload($product)
    {
        if (!empty($this->image)) {
            foreach ($this->image as $image) {
                $imageName = $product->name . '-' . $product->images()->count() + 1 . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('products', $imageName, 'public');
                $product->images()->create(['image_url' => $imagePath]);
            }
        }
    }


    public function BackTo()
    {
        $this->updateSelectedProduct = null;
        $this->image = null;
    }
}
