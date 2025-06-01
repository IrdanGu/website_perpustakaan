<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use PhpParser\Node\Expr\FuncCall;

class UserComponent extends Component

{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama,$email,$password, $id, $cari;
    public function render()
    {
        $layout['title'] = 'User Management';
        
        if ($this->cari != ""){
            $data['users'] = User::where('nama', 'like', '%' . $this->cari . '%')
                ->orWhere('email', 'like', '%' . $this->cari . '%')
                ->paginate(10);
        }else{
            $data['users'] = User::paginate(10);
        }
        return view('livewire.user-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'nama.required' => 'Nama is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => $this->password,
            'jenis' => 'admin',
        ]);

        session()->flash('success', 'User created successfully.');
        $this->reset(['nama', 'email', 'password']);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->id = $user->id;
    }
    public function update(){
        

        $user = User::findOrFail($this->id);
        if ($this->password == "") {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
            ]);
        } else {
            $user->update([
                'nama' => $this->nama,
                'email' => $this->email,
                'password' => $this->password,
            ]);
            
        }

        session()->flash('success', 'User updated successfully.');
        $this->reset(['nama', 'email', 'password', 'id']);
    }
    public function confirm($id)
    {
        $this->id = $id;
    }
    public function destroy()
    {
        $user = User::findOrFail($this->id);
        $user->delete();
        session()->flash('success', 'User deleted successfully.');
        $this->reset();
    }
}