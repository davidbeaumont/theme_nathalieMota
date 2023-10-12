<div class="selectors">
    <div class="select-gauche">
        <div name="categories" class="select_categories">
            <div class="champ" value=""><span class="categorie-text">Catégories</span>
                <img class="icon-chevron" src="<?php echo get_template_directory_uri() . '/img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <div class="choix">
                <?php
                // Récupère les termes de votre taxonomie
                $terms = get_terms('categorie');
                
                // Parcoure les termes et crée une option pour chaque terme
                foreach ($terms as $term) {
                    echo '<div class="option hidden" value="'.esc_html($term->name).'">'.esc_html($term->name).'</div>';
                }
                ?>
            </div>
        </div>
        <div name="formats" class="select_formats">
            <div class="champ" value=""><span class="format-text">Formats</span>
                <img class="icon-chevron" src="<?php echo get_template_directory_uri() . '/img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <div class="choix">
                <?php
                // Récupère les termes de la taxonomie
                $terms = get_terms('format');
                // Parcoure les termes et crée une option pour chaque terme
                foreach ($terms as $term) {
                    echo '<div class="option hidden">'.esc_html($term->name).'</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="select-droit">
        <div name="tri" class="select_tri">
            <div class="champ" value=""><span class="tri-text">Trier par</span>
                <img class="icon-chevron"
                src="<?php echo get_template_directory_uri() . '/img/down.png'; ?>"
                alt="Icône chevron bas">
            </div>
            <div class="choix">
                <div class="option hidden" value="ASC">Ordre Croissant</div>
                <div class="option hidden" value="DESC">Ordre Décroissant</div>
            </div>
        </div>
    </div>
</div>