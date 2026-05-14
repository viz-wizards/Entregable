<?php

if(!function_exists('e')){
    function e($valor): string {
        return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8');
    }
}


if(!function_exists('money')){
    function money($valor): string {
        return 'S/ ' . number_format((float)$valor, 2, '.', ',');
    }
}

if(!function_exists('selectedOption')){
    function selectedOption($actual, $esperado): string {
        return (string)$actual === (string)$esperado ? 'selected' : '';
    }
}

if(!function_exists('formDate')){
    function formDate($valor): string {
        return e($valor ?: date('Y-m-d'));
    }
}


if(!function_exists('badgeClass')){
    function badgeClass(string $estado): string {
        $estado = strtolower($estado);
        if(in_array($estado, ['activo','pagado','disponible'], true)){
            return 'badge ok';
        }
        if(in_array($estado, ['pendiente','agotado'], true)){
            return 'badge warn';
        }
        return 'badge danger';
    }
}


if(!function_exists('redirect')){
    function redirect(string $url){
        header("Location: $url");
        exit;
    }
}


if(!function_exists('validarEmail')){
    function validarEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}


if(!function_exists('validarEntero')){
    function validarEntero(int $num): bool {
        return $num > 0;
    }
}

if(!function_exists('fechaFormateada')){
    function fechaFormateada(string $fecha): string {
        $dt = new DateTime($fecha);
        return $dt->format('d/m/Y');
    }
}


if(!function_exists('slug')){
    function slug(string $texto): string {
        $texto = strtolower(trim($texto));
        $texto = preg_replace('/[^a-z0-9-]+/', '-', $texto);
        $texto = preg_replace('/-+/', '-', $texto);
        return trim($texto, '-');
    }
}
?>