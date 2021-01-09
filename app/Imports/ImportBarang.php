<?php

namespace Larisso\Imports;

use Larisso\Barang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportBarang implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
      foreach ($collection as $i => $value) {
        if ($i > 0) {
          if ($value[0] != '') {
            $insert = Barang::insert([
              'kd_brg'         => $value[0],  
              'jns_brg' 	     => $value[1],      
              'nm_brg'         => $value[2],  
              'stok'           => $value[3],
              'satuan1'        => $value[4],  
              'satuan2'        => $value[5],  
              'satuan3'        => $value[6],  
              'satuan4'        => $value[7],  
              'sat_tur2'       => $value[8],  
              'sat_tur3'       => $value[9],  
              'sat_tur4'       => $value[10],  
              'kapasitas2'     => $value[11],      
              'kapasitas3'     => $value[12],      
              'kapasitas4'     => $value[13],      
              'harga_bl'       => $value[14],    
              'harga_jl'       => $value[15],    
              'harga_jl2'      => $value[16],    
              'harga_jl3'      => $value[17],    
              'harga_jl4'      => $value[18],    
              'qty_min2'       => $value[19],    
              'qty_min3'       => $value[20],    
              'qty_min4'       => $value[21],    
              'gambar'         => $value[22]  
            ]);
          }
        }
      }
      if ($insert) {
          return true;
      }
    }
  }
