<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\ProductType;

class HeaderLandingPageComposer
{
    public function compose(View $view)
    {
        // Ambil data yang ingin dibagikan
        $productTypes = ProductType::all();

        // Bagikan data ke view
        $view->with('productTypes', $productTypes);
    }
}