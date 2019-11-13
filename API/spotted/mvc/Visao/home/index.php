

<div class="row">
    <div class="col s12 m12 center">
        <div class="card  darken-1 z-depth-5">
            <div class="card-content">
                <span class="card-title">Bem Vindo ao <span id="logo">Spotted UTFPR-GP</span></span>
                <p>
                    O Spotted 2.0 veio com intenção de ajudar a você conquistar o seu crush, mas… essa aplicação tem a intenção de não ofender ninguém, seja responsável e pense antes de escrever ou enviar alguma foto constrangedora, pois ninguém quer ser ofendido, nem você e nem o seu crush. Use com responsabilidade, A aplicação tem a intenção de ser totalmente anônimo, mas hoje na internet nada é tão anônimo, então se cuide.


                </p>
            </div>
            <div class="card-action">

                <span class="card-title"><span id="logo">Spotted UTFPR 2.0</span></span>


                <div class="row">
                    <form class="col s12" action="<?= URL_RAIZ . 'cadastroUsuario' ?>" method="post" class="form-inline pull-left" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea"></textarea>
                                <label for="textarea1">Insira aqui a sua super cantata, que vai dar boas! 😉</label>
                            </div>
                        </div>



                        <div class="row">
                            <div class="input-field col offset-s2 s12  m12  ">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>A fotinha do seu amado crush 😍</span>
                                        <input id="foto" name="foto" type="file">
                                    </div>

                                    <div class="file-path-wrapper ">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="center form">

                            <button class="btn waves-effect waves-light" type="submit" name="action">
                                Enviar Spotted 🙈<i class="material-icons right"><img class="icons-buttons" src="<?= URL_IMG . 'icons/send.svg' ?>"></i>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>