<?php

namespace App\Services;
use Endroid\QrCode\Builder\BuilderInterface;
use App\Entity\Plannification;

class QRCodeService
{
    protected $builder;
    public function __construct(BuilderInterface $builder)
    {
        $this->builder=$builder;

    }

    public function qrcode(int $id)
    {
        $result= $this->builder
            ->data($id)
            ->size(150)
            ->margin(10)
            ->labelText("QR CODE")
            ->build()
            ;


        return $result->getDataUri();

    }

}