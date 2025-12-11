<?php
class viewModel{
    protected static function get_view($view){
$white_list = [
    "home", "products", "users", "new-user", "categories", "edit-user",
    "new-producto", "new-categoria", "producto-lista", "categorias-lista",
    "productos-edit", "categoria-edit",
    // Nuevas vistas para clientes y proveedores
    "clients", "new-client", "edit-client",
    "proveedores", "new-proveedor", "edit-proveedor","productos-lista","ejemplo","dashboard"
];
        if (in_array($view, $white_list)) {
            if (is_file("./view/".$view.".php")) {
                $content = "./view/".$view.".php";
            }else{
                $content = "404";
            }
        }elseif($view == "login"){ 
            $content = "login";
        }else{
            $content = "404";
        }
         return $content;
    }
}