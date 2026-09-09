<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
        $this->call->library('session');
        $this->call->library('form_validation');
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->get_all();
        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

    public function store()
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('product_name')->required()
                ->name('price')->required()->numeric()
                ->name('quantity')->required()->numeric();

            if ($this->form_validation->run()) {
                $data = [
                    'product_name' => $this->io->post('product_name'),
                    'description'  => $this->io->post('description'),
                    'price'        => $this->io->post('price'),
                    'quantity'     => $this->io->post('quantity')
                ];
                
                $this->ProductModel->create($data);
                $this->session->set_flashdata('success', 'Product created successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('error', 'Validation failed.');
                redirect('products/create');
            }
        }
    }

    public function edit($id)
    {
        $data['product'] = $this->ProductModel->get_by_id($id);
        if (!$data['product']) {
            redirect('products');
        }
        $this->call->view('products/edit', $data);
    }

    public function update($id)
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('product_name')->required()
                ->name('price')->required()->numeric()
                ->name('quantity')->required()->numeric();

            if ($this->form_validation->run()) {
                $data = [
                    'product_name' => $this->io->post('product_name'),
                    'description'  => $this->io->post('description'),
                    'price'        => $this->io->post('price'),
                    'quantity'     => $this->io->post('quantity')
                ];
                
                $this->ProductModel->update($id, $data);
                $this->session->set_flashdata('success', 'Product updated successfully.');
                redirect('products');
            } else {
                $this->session->set_flashdata('error', 'Validation failed.');
                redirect('products/edit/' . $id);
            }
        }
    }

    public function delete($id)
    {
        $this->ProductModel->delete($id);
        $this->session->set_flashdata('success', 'Product deleted successfully.');
        redirect('products');
    }
}
