




    //
    jQuery(function($hulled) {
        function search_h_area(){
            $hulled('.list-courses-per-area').click(function (){
                var testtee = $hulled(this).attr('data-area')
                var loader = "<div class='hulled-lader' style='position: absolute; z-index: 99999999999;'><img src='https://prominas.online/wp-content/uploads/2022/12/loader.gif' style='width: 54px;'></div>";
                $hulled(this).append(loader);
                console.log(testtee)
                $hulled.ajax({
                    type: "POST",
                    url: "/wordpress/wp-admin/admin-ajax.php",
                    dataType: "json",
                    data: {
                        action: "hulled_search_list_course_per_area",
                        area: testtee
                    },
                    success: function (data) {
                        console.log("Ajax foi execuldado.");
                        $hulled('.remove_content-areas').remove();
                        $hulled('.search-content-list-courses').append(data);
                   }
                })
            })
        }


        function search_h_courses(){
            let area_input = $hulled('#area_input').val();
            let modality_input = $hulled('#modality_input').val();
        
            console.log(area_input, modality_input);
            area_input == undefined ? '' : area_input;
            var api_url = "https://api-lyratec.institutoprominas.com.br/v2/search_courses";
            var typ =  "?&area="+ area_input /*+ "&limit="+ limit*/ + "&search=";
            var clicked_item = false;

            window.addEventListener("load", function () {
                var form = document.querySelector('*[id^="coursesearch"]');
                var name_input = document.querySelector('#coursesearch');
                if (name_input) {
                    name_input.addEventListener('input', () => {
                        // Obtemos o valor:
                        console.log(name_input.value);
                    });/*form.querySelector("input.search-input");*/
                    var course_list = document.getElementById("course_list");
                    name_input.addEventListener("focus", function () {
                        course_list.classList.remove("d-none");
                    });
                    name_input.addEventListener("blur", function () {
                        console.log(name_input.value);
                        setTimeout(function () {
                            if (!clicked_item) course_list.classList.add("d-none");
                            else clicked_item = false;
                        }, 200);
                    });
        
                    name_input.addEventListener("keyup", function (event) {
                        var modality = "pos-graduacao";
                        if (modality == 'graduacao') {
                            modality = 'bacharelado,licenciatura,tecnologico'
                        }
                        hinter(event, typ_url = modality, area_input);
                    });
                    window.hinterXHR = new XMLHttpRequest();
                }
            });
            function hinter(event, type_url,area_input) {
                var course_name = event.target.value;
                var min_characters = 3;
                if (course_name.length >= min_characters) {
                    course_list.innerHTML = "";
                    window.hinterXHR.abort();
                    window.hinterXHR.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = JSON.parse(this.responseText);
                            console.log(response);
                            response.data.forEach(function (course) {
                                console.log(course);
                                var item = document.createElement("li");
                                var link = document.createElement("a");
                                item.innerHTML = course.name;
        
                                let area = {
                                    'jurídica': 'juridica',
                                    'Engenharias': 'engenharias',
                                    'Ciências da Saúde': 'ciencias-da-saude',
                                    'Psicologia': 'psicologia',
                                    'Meio Ambiente': 'meio-ambiente',
                                    'MBA Executivo': 'mba-executivo',
                                    'Serviço social': 'servico-social',
                                    'Educação': 'educacao',
                                    'Estética': 'estetica',
                                    'Empresarial, TI e NegÃ³cios': 'empresarial-ti-e-negocios',
                                    'Gastronomia': 'gastronomia'
                                };
                                let convert_type_url = {
                                    'Pós-Graduação': 'pos-graduacao',
                                    'Extensão': 'extensao',
                                    'Bacharelado': 'graduacao/bacharelado',
                                    'Licenciatura': 'graduacao/licenciatura',
                                    'Tecnológico': 'graduacao/tecnologico',
                                    'Aperfeiçoamento': 'aperfeicoamento'
                                }
                                let area_alias = area[course.area];
                                let area_url = "/" + area_alias + "/";
                                if (course.type == "Bacharelado" || course.type == "Licenciatura" || course.type == "TecnolÃ³gico"){
                                    area_url = '/';
                                }
                                link.href = "/" + convert_type_url[course.type] + area_url + course.alias;
                                console.log(link.href + "link aui");


                                item.onclick = function () {
                                    clicked_item = true;
                                    console.log(course.area);
        
                                    console.log(area);
                                    var form = document.querySelector('*[id^="coursesearch"]');
                                    var name_input = course.alias;
                                    const field = document.querySelector('#coursesearch');
                                    console.log(name_input);
                                    field.addEventListener('input', () => {
                                        console.log(field.value);
                                    });
                                    name_input.value = course.alias;
                                    console.log(name_input.value);
                                    clicked_item = false;
                                };
                                link.appendChild(item);
                                course_list.appendChild(link);
                            });
                        }else{
                            console.log("nao achoei")
                        }
                    };
                    var url = api_url + '/' +  typ_url + '?' + area_input + '&search=' + course_name + '&certifiers=Faculdade%20%C3%9ANICA|Faculdade%20Prominas'

                    if (area_input && area_input.value && area_input.value != "*") url += "&areas=" + area_input.options[area_input.selectedIndex].innerHTML;
                    window.hinterXHR.open("GET", url, true);
                    window.hinterXHR.send();
                }
            }
        }
        //iniciar funcoes 
        search_h_courses()
        search_h_area();
    });

