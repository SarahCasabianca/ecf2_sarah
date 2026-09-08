
<div class="stats">

    <?php foreach ($rankings as $ranking): ?>

        <?php $loss = round($ranking['nb_absences'] * (712 / 21), 2); ?>

        <div class="carte-stagiaire">

            <p><?= htmlspecialchars($ranking['intern_name']) ?> <?=  htmlspecialchars($ranking['intern_surname']) ?></p>
            <p>Absences : <?=  $ranking['nb_absences'] ?></p>
            <p>Perte estimée : <?= $loss ?></p>
            
        </div>

    <?php endforeach; ?>

</div>