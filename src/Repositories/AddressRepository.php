<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Address;
use Referenzverwaltung\Interfaces\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
    public function getAll() 
    {
        return Address::all();
    }

    public function getById(int $id) 
    {
        return Address::findOrFail($id);
    }

    public function delete(int $id) 
    {
        Address::destroy($id);
    }

    public function create(array $modal) 
    {
        return Address::create($modal);
    }

    public function update(int $id, array $newModal) 
    {
        return Address::whereId($id)->update($newModal);
    }
}
