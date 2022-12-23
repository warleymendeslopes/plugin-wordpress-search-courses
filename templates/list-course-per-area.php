<?php
//echo "aqui deve ser listadas os cusos de ". $data->area;
$api = new PiagetService();
$courses_destaque = $api->sucess_courses('pos-graduacao',$data->area, 4, 'destaque');

echo "<h1 class='hulled-search-title title-seach-area'>Cursos em Destaque</h1>";
foreach ($courses_destaque->data as $key => $value) {?>
    <div role="link" tabindex="0" id="pesqui" data-index="3" data-course="<?php echo $value->alias; ?>" class="_1jbb9y7 list-courses-per-area">
        <div class="_jro6t0">
            <div class="_1i6wphy"> <img class="_w6ax09" alt="" src="<?php echo $value->photo_miniature; ?>"></div>
            <div class="_1825a1k">
                <div class="_4za9uz"><?php echo $value->name; ?></div>
                <div class="_i1xie3"><?php echo $value->type; ?></div>
            </div>
        </div>
    </div>

<?php
}
echo "<h1 class='hulled-search-title title-seach-area'>lista de cursos</h1>";


$courses = $api->sucess_courses('pos-graduacao',$data->area,10,$tags);


foreach ($courses->data as $key => $value) {?>
    <div role="link" tabindex="0" id="pesqui" data-index="3" data-course="<?php echo $value->alias; ?>" class="_1jbb9y7 list-courses-per-area">
        <div class="_jro6t0">
            <div class="_1i6wphy"> <img class="_w6ax09" alt="" src="<?php echo $value->photo_miniature; ?>"></div>
            <div class="_1825a1k">
                <div class="_4za9uz"><?php echo $value->name; ?></div>
                <div class="_i1xie3"><?php echo $value->type; ?></div>
            </div>
        </div>
    </div>

<?php
}
