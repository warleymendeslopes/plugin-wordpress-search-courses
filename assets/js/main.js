




    //
    jQuery(function($hulled) {
        
        function search_h_area(){
            $hulled('.list-courses-per-area').click(function (){
                var testtee = $hulled(this).attr('data-area')
                console.log(testtee)
                $hulled.ajax({
                    type: "POST",
                    url: "/plugin_search/wp-admin/admin-ajax.php",
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

        function script_search_header(){
            // Busca header
            /*let area_input = "area="+document.getElementById('area_input').value;
            let typ_url = document.getElementById('modality_input').value;*/
            let area_input = "area="+$hulled('#area_input').val();
            let typ_url = $hulled('#modality_input').val();
        
            /*console.log(area_input, modality_input);*/
            console.log(area_input, typ_url);
            area_input == null ? '' : area_input;
            var api_url = "https://public-api.faculdadeesp.com.br/v2/search_courses";
            area = window.location.pathname.split('/');
            ty = area[1];
            area = area[2];
            var typ =  "&search=";
            var clicked_item = false;
            $hulled('#firstformtype').on('change', function (){
                typ_url = $hulled(this).val();
                //$('.searchdivheader #headersearch').attr('placeholder', getPlaceholders($(this).val()));
            });
            window.addEventListener("load", function () {
                var form = document.querySelector('*[id^="headersearch"]');
                var name_input =
                    document.querySelector('#headersearch');
                name_input.addEventListener('input', () => {
                    // Obtemos o valor:
                    console.log(name_input.value);
                });/*form.querySelector("input.search-input");*/
                var courses_list = document.getElementById("courses_list");
                name_input.addEventListener("focus", function () {
                    courses_list.classList.remove("d-none1");
                });
                name_input.addEventListener("blur", function () {
                    console.log(name_input.value);
                    setTimeout(function () {
                        if (!clicked_item) courses_list.classList.add("d-none1");
                        else clicked_item = false;
                    }, 200);
                });
                name_input.addEventListener("keyup", function (event) {
                    hinter(event, typ_url,area_input);
                });
                window.hinterXHR = new XMLHttpRequest();
            });
            function hinter(event, type_url,area_input) {
        
                console.log('sdfds',area_input);
                console.log(type_url);
                var type1 = $hulled('#firstformtype').val()
                var course_name = event.target.value;
                var min_characters = 3;
                if (course_name.length >= min_characters) {
                    courses_list.innerHTML = "";
                    window.hinterXHR.abort();
                    window.hinterXHR.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = JSON.parse(this.responseText);
                            console.log(response);
                            response.data.forEach(function (course) {
                                var item = document.createElement("li");
                                var link = document.createElement("a");
                                link.innerHTML = course.name;
                                let area = {
                                    'Saúde': 'saude',
                                    'Educação': 'educacao',
                                };
                                let convert_type_url = {
                                    'Pós-Graduação': 'pos-graduacao',
                                    'Extensão': 'extensao',
                                    'Bacharelado': 'primeira-graduacao/bacharelado',
                                    'Licenciatura': 'primeira-graduacao/licenciatura',
                                    'Tecnológico': 'primeira-graduacao/tecnologico',
                                    'Aperfeiçoamento': 'aperfeicoamento'
                                }
                                let area_alias = area[course.area];
                                let area_url = "/" + area_alias + "/";
                                if (course.type == "Bacharelado" || course.type == "Licenciatura" || course.type == "Tecnológico"){
                                    area_url = '/';
                                }
                                link.href = "/" + convert_type_url[course.type] + area_url + course.alias;
                                item.onclick = function () {
                                    clicked_item = true;
                                    var form = document.querySelector('*[id^="headersearch"]');
                                    var name_input = form.querySelector("input.searchinput");
                                    const field = document.querySelector('#headersearch');
        
                                    field.addEventListener('input', () => {
                                        console.log(field.value);
                                    });
                                    console.log(course);
                                    name_input.value = course.name;
                                    clicked_item = false;
                                };
                                item.appendChild(link);
                                courses_list.appendChild(item);
                            });
                        }
                    };
                    console.log(area_input);
                    var url = api_url + '/' +  typ_url + '?' + area_input + '&search=' + course_name + '&Faculdade_Alpha%7CFaculdade_ESP%7CFaculdade_de_Educação_Paulistana';
                    // var area_input = document.querySelector('.active').innerText;
                    var area_input = $('#firstformtype').val();
                    if (area_input && area_input.value && area_input.value != "*") url += "&areas=" + area_input.options[area_input.selectedIndex].innerHTML;
                    window.hinterXHR.open("GET", url, true);
                    window.hinterXHR.send();
                }
            }
        }
        


        //iniciar funcoes 
        search_h_area();
    });