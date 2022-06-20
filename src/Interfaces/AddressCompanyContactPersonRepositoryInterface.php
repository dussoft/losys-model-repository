<?php

namespace Referenzverwaltung\Interfaces;

interface AddressCompanyContactPersonRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function delete(int $id);
    public function create(array $modal);
    public function update(int $id, array $newModal);
}
