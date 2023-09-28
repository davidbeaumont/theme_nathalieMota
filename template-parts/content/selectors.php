<div class="selectors">
    <div class="select-gauche">
        <div name="categories" class="select_categories">
            <div class="champ" value="">CAT&EacuteGORIES
                <img class="icon-chevron" src="<?php echo get_template_directory_uri() . './img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <?php
            // Récupérez les termes de votre taxonomie
            $terms = get_terms('categorie');
            
            // Parcourez les termes et créez une option pour chaque terme
            foreach ($terms as $term) {
                echo '<div class="options hidden" value="'.esc_html($term->name).'">'.esc_html($term->name).'</div>';
            }
            ?>
        </div>

        <div name="formats" class="select_formats">
            <div class="champ" value="">FORMATS
                <img class="icon-chevron" src="<?php echo get_template_directory_uri() . './img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <?php
            // Récupérez les termes de votre taxonomie
            $terms = get_terms('format');

            // Parcourez les termes et créez une option pour chaque terme
            foreach ($terms as $term) {
                echo '<div class="options hidden">'.esc_html($term->name).'</div>';
            }
            ?>
        </div>
    </div>
    <div class="select-droit">
        <div name="tri" class="select_tri">
            <div class="champ" value="">TRIER PAR
                <img class="icon-chevron"
                src="<?php echo get_template_directory_uri() . './img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <div class="options hidden" value="asc"><a href="#">Ordre Croissant</a></div>
            <div class="options hidden" value="desc"><a href="#">Ordre Décroissant</a></div>
        </div>
    </div>
</div>