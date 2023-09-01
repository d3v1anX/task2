<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Cjmellor\Approval\Models\Approval;
use App\Livewire\Approvals as ApprovalLW;
use Livewire\Attributes\On;

class Products extends Component
{
    public $products;
    public $product;
    public $id;
    public $product_name;
    public $product_description;
    public $sku;
    public $vendor_id;
    public $product_group_id;
    public $status;
    
    public $user;

    public $team;
    public $confirmingProductUpdate = 0;
    public $isOpen = 0;

   // protected $listeners = ['productAproved' => 'render'];

    #[On('productAproved')] 
    public function render()
    {
        $this->products = Product::all();
        $this->user = Auth::user();

        $this->team = Team::find($this->user->current_team_id);

        $can_list = $this->user->can('product-list');

        //dd( $this->team->userHasPermission($this->user, 'product:read'));
        if ($can_list)
            return view('livewire.products');
        else
            abort(403, 'Forbidden');
    }

    public function edit(Product $product)
    {
        

        if (Approval::where('approvalable_id',$product->id)->pending()->count()> 0){

            session()->flash('message','The product has changes pending approval');
           

        } else {

            $this->product = $product;
            $this->confirmingProductUpdate = true;
    
            $this->id = $this->product->id;
    
            $this->product_name = $this->product->product_name;
    
            $this->product_name= $this->product->product_name;
            $this->product_description= $this->product->product_description;
            $this->sku= $this->product->sku;
            $this->vendor_id= $this->product->vendor_id;
            $this->product_group_id= $this->product->product_group_id;
            $this->status= $this->product->status;
            $this->openModal();
        }
        
    }

   
    public function openModal()
    {
        $this->isOpen = true;
    }

  
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function update(){

        // Validate request
       

        try{

            // Update product table
            Product::find($this->id)->fill([
                'prodcut_name'=>$this->product_name,
                'product_description'=>$this->product_description,
                'sku'=>$this->sku,
                'product_group_id'=>$this->product_group_id
            ])->save();

           // $this->dispatch('NewUpdateProduct');
            $this->dispatch('NewUpdateProduct')->to(ApprovalLW::class);

            if (Approval::where('approvalable_id',$this->id)->pending()->count()> 0){
                
                session()->flash('message','Changes were updated pending approval');
            } else {
                session()->flash('message','Product Updated Successfully!!');
            }

           
            
    
            $this->closeModal();
        }catch(\Exception $e){
            session()->flash('message','Unexpected Error:'. $e->getMessage());
           
            $this->closeModal();
        }
    }

}
