<?php
$myfiles = scandir(dirname(__FILE__).'/apis');
$count=2; $apis=[];
foreach($myfiles as $file){
    if($count < count($myfiles))
        $apis[]=include 'apis/'.$myfiles[$count++] ;
}
return
[
    'name'=>'seyana',
    'description'=>'this appliction is Facilitates communication between service providers',
    'baseUrl'=>Request()->root().'/api/',
    'apis'=>$apis
];
