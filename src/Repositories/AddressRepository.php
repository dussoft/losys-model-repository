<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Address;
use Referenzverwaltung\Interfaces\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface
{
    public function getAll() 
    {
        return Photo::all();
    }

    public function getById(int $id) 
    {
        return Photo::findOrFail($id);
    }

    public function delete(int $id) 
    {
        Photo::destroy($photoId);
    }

    public function create(array $modal) 
    {
        return Photo::create($modal);
    }

    public function update(int $id, array $newModal) 
    {
        return Photo::whereId($id)->update($newModal);
    }
}
