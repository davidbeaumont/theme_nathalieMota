<div class="selectors">
    <div class="select-gauche">
        <select name="categories" class="select_categories">
            <option value="">CAT&EacuteGORIES</option>
            <?php
            // Récupérez les termes de votre taxonomie
            $terms = get_terms('categorie'); // Remplacez 'votre_taxonomie' par le nom de votre taxonomie

            // Parcourez les termes et créez une option pour chaque terme
            foreach ($terms as $term) {
                echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
            }
            ?>
        </select>
        <select name="formats" class="select_formats">
            <option value="">FORMATS</option>
            <?php
            // Récupérez les termes de votre taxonomie
            $terms = get_terms('format'); // Remplacez 'votre_taxonomie' par le nom de votre taxonomie

            // Parcourez les termes et créez une option pour chaque terme
            foreach ($terms as $term) {
                echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="select-droit">
        <select name="tri" class="select_tri">
            <option value="">TRIER PAR</option>
            <option value="asc">Ordre Croissant</option>
            <option value="desc">Ordre Décroissant</option>
        </select>
    </div>

</div>