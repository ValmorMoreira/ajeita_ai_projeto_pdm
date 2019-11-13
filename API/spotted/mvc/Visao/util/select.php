<?php
//var_dump( "Teste do campo: ".$campo);

if (isset($dificuldade)) {
    switch ($dificuldade) {
        case 'facil':
            echo '<div class="input-field col m4 s12">
                <select name="select" id="select">
                    <option value="facil">Fácil 😇</option>
                    <option value="media">Mediana 😅</option>
                    <option value="dificil">Difícil 😈</option>
                </select>
                <label>Nível da questão</label>

            </div>';
            break;

        case 'media':
            echo ' <div class="input-field col m4 s12">
                  <select name="select" id="select">
                      <option value="facil">Fácil 😇</option>
                      <option selected value="media">Mediana 😅</option>
                      <option value="dificil">Difícil 😈</option>
                  </select>
                  <label>Nível da questão</label>

              </div>';
            break;

        case 'dificil':
            echo ' <div class="input-field col m4 s12">
                    <select name="select" id="select">
                        <option value="facil">Fácil 😇</option>
                        <option  value="media">Mediana 😅</option>
                        <option selected value="dificil">Difícil 😈</option>
                    </select>
                    <label>Nível da questão</label>

                </div>';
            break;

        default:
            // code...
            break;
    }


} else {
    echo '<div class="input-field col m4 s12">
                <select name="select" id="select">
                 <option value="facil">-----</option>
                    <option value="facil">Fácil 😇</option>
                    <option value="media">Mediana 😅</option>
                    <option value="dificil">Difícil 😈</option>
                </select>
                <label>Nível da questão</label>

            </div>';


}
?>


