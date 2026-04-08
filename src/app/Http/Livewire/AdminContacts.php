<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;
use App\Models\Category;

class AdminContacts extends Component
{
    use WithPagination;

    public $keyword = '';
    public $gender = 'placeholder';
    public $category_id = '';
    public $created_at = '';
    public $showModal = false;
    public $selectedContact = null;

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function updatingGender()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatingCreatedAt()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->keyword = '';
        $this->gender = 'placeholder';
        $this->category_id = '';
        $this->created_at = '';
        $this->resetPage();
    }

    public function showDetail($id)
    {
        $this->selectedContact = Contact::with('category')->findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedContact = null;
    }

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        $this->closeModal();
        session()->flash('message', '削除しました');
    }

    public function render()
    {
        $categories = Category::all();

        $contacts = Contact::with('category')
            ->CategorySearch($this->category_id)
            ->KeywordSearch($this->keyword)
            ->GenderSearch($this->gender === 'placeholder' ? '' : $this->gender)
            ->DateSearch($this->created_at)
            ->paginate(7);

        return view('livewire.admin-contacts', compact('contacts', 'categories'));
    }
}