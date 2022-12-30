<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>




    .trigger {
		background-color: #007afa00;
		border: 1px solid #46485f;
		padding: 5px 20px 5px 20px;
		cursor: pointer;
		color: #46485f;
		border-radius: 7px;
	}
    

    .modal {
      width: 100%;
      height: 100%;
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 10;
      background-color: rgb(255 255 255);
      overflow: auto;
    }

    .modal-content {
      position: relative;
      width: 80%;
      text-align: center;
      margin: 30px auto 0;
	  border: none;
    }

    .modal-content p {
      font-size: 35px;
      color: #000;
      line-height: 0;
    }

    .modal .btn-close {
      position: absolute;
      top: 20px;
      right: 45px;
      cursor: pointer;
      color: black;
    }

    .modal input[type=text] {
      width: 80%;
      float: left;
      border: none;
      padding: 15px;
      box-sizing: border-box;
      border: 1px solid #00000087;
    }

    .modal button {
      width: 20%;
      float: left;
      border: none;
      padding: 15px;
      cursor: pointer;
      background-color: #007afa;
      color: #fff;
    }

    form.hulled-search-form-courses {
      position: absolute;
      width: 100%;
    }

    .hulled-response-areas {
      position: relative;
      top: 88px;
    }
	  @media (min-width: 768px){
		.modal-content {
			box-shadow: 0 5px 15px rgb(0 0 0 / 0%);
		}
	  }

    #pesqui {
        padding: 1em 0px;
        border-bottom: 1px solid #ededed;
        margin: 0px 16px;
        cursor: pointer;
    }
    ._jro6t0 {
        display: flex;
    }
    ._1i6wphy {
        border-radius: 8px ;
        min-width: 48px ;
        height: 48px ;
        margin-right: 16px ;
    }
    ._w6ax09 {
        object-fit: cover ;
        width: 48px ;
        height: 48px ;
    }
    ._1825a1k {
        width: 100% ;
        display: flex ;
        flex-direction: column ;
        justify-content: center ;
        text-align: left;
    }
    ._4za9uz {
        font-size: 16px ;
        line-height: 20px ;
        font-weight: 400 ;
        color: #222 ;
        overflow: hidden ;
        text-overflow: ellipsis ;
        display: -webkit-box ;
        -webkit-line-clamp: 6 ;
        -webkit-box-orient: vertical ;
    }
    ._i1xie3 {
        font-size: 12px ;
        line-height: 16px ;
        font-weight: 400;
        color: #717171;
    }
    .title-seach-area{
      background: #ededed;
      padding-top: 0.2em ;
      padding-bottom: 0.2em ;
      letter-spacing: .1em;
      margin: 0.5em 0em ;
      font-weight: 800;
      font-size: .8em;
      text-transform: uppercase;
      text-align: left;
      padding: 10px 10px 10px 20px;
    }
  </style>
<body>



















  <!-- modal -->
  <div class="modal" id="search-modal">
    <!-- trigger untuk menutup modal -->
    <span class="btn-close" onclick="closeModal()" title="Close">
      <i class="fa fa-close"></i></span>

    <!-- isi modal -->
    <div class="modal-content">
      <p>Cursos de Pós-Graduação</p>
      <form action="#" class="hulled-search-form-courses">
        <input class="search-input" id="coursesearch" type="text" placeholder="Ex: Engenharia de Segurança do Trabalho"><button><i class="fa fa-search search-button"></i></button>
      </form>


          <div class="wpb_text_column wpb_content_element">
            <div class="wpb_wrapper">
              <ul id="course_list" class="d-none"></ul>
            </div>
          </div>


        <div class="hulled-response-areas">
          
          <div class="search-content-list-courses">


            <div class="remove_content-areas">
            <h4 class="title-seach-area"> EXPLORE NOSSAS ÁREAS </h4>
              <?php  
                //print_r($data->areas->data);
                foreach ($data->areas->data as $key => $value) { ?>
                  <div role="link" tabindex="0" id="pesqui" data-index="3" data-area="<?php echo $value->areaAlias ?>" class="_1jbb9y7 list-courses-per-area">
                  
                    <div class="_jro6t0">
                      <div class="_1i6wphy"> <img class="_w6ax09" alt="" src="<?php echo $value->miniature ?>"></div>
                      <div class="_1825a1k">
                        <div class="_4za9uz"><?php echo $value->areaName ?></div>
                        <div class="_i1xie3"><?php echo $value->qtd ?> cursos disponíveis</div>
                      </div>
                    </div>
                  </div>
                <?php  }  
              ?>
            </div>
          

        </div>
      </div>
    </div>
  </div> <!-- end modal -->



  <script>
    // fungsi untuk membuka modal search
    function openSearch() {
      document.getElementById('search-modal').style.display = "block";
    }
    // fungsi untuk menutup modal search
    function closeModal() {
      document.getElementById('search-modal').style.display = "none";
    }





  </script>
  <!-- trigger untuk menampilkan modal -->
  <button class="trigger" onclick="openSearch()">
    <i class="fa fa-search"></i> <?php echo $data->foo; ?></button>
</body>

</html>