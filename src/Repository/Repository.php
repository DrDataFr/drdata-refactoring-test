<?php

interface Repository
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);
}