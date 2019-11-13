<?php
if ($this->temErro($campo)): ?>
    <div class="center animated shake delay-1s">
        <span class="red-text"><?= $this->getErro($campo) ?></span>

    </div>
<?php endif ?>