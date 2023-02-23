<?php $filter_args = get_theme_filter_global_args(); ?>
<?php $filter_data = get_theme_filter_data(); 
    $proximities_filter_args    = isset( $filter_data['proximities'] )  ? $filter_data['proximities']   : [];
    $housing_filter_args        = isset( $filter_data['housing'] )      ? $filter_data['housing']       : [];
    $deadline_filter_args       = isset( $filter_data['deadline'] )     ? $filter_data['deadline']      : [];
    $is_service_checked         = $filter_data['service'];
?>
<div class="page-filter fixed">
    <div class="page-filter__wrapper">
        <form id="page-filter" class="page-filter__form">
        <div class="page-filter__body">
            <?php if( $proximities_filter_args ) : ?>
            <div class="page-filter__category">
            <a href="#proximity" class="page-filter__category-link" data-toggle="collapse">
                <h3 class="page-title-h3">Близость к метро</h3>
                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z" fill="#111111" />
                </svg>
            </a>
            <div class="page-filter__category-list collapse show" id="proximity">
                <ul class="proximity">
                    <?php foreach( $proximities_filter_args as $proximity ) : $id = $proximity['id']; ?>
                    <li class="<?php echo isset( $proximity['li_class'] ) ? $proximity['li_class'] : ''; ?>">
                        <div class="checkbox">
                        <input 
                            type="checkbox"
                            name="<?php echo $id; ?>"
                            id="<?php echo $id; ?>"
                            data-is-proximity="1"
                            <?php echo $proximity['checked'] ? 'checked' : ''; ?>
                        />
                        <label for="<?php echo $id; ?>"><?php echo $proximity['text']; ?></label>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            </div>
            <?php endif; ?>
            <?php if( $deadline_filter_args  ) : ?>
            <div class="page-filter__category">
                <a href="#deadline" class="page-filter__category-link" data-toggle="collapse">
                    <h3 class="page-title-h3">Срок сдачи</h3>
                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z" fill="#111111" />
                    </svg>
                </a>
                <div class="page-filter__category-list collapse show" id="deadline">
                    <ul class="deadline">
                    <?php foreach( $deadline_filter_args as $deadline ) : $id = $deadline['id'];?>
                        <li>
                            <div class="radio">
                            <input
                                type="radio"
                                name="deadline"
                                id="<?php echo $id; ?>"
                                value="<?php echo $id; ?>"
                                <?php echo isset($deadline['checked']) && $deadline['checked'] ? 'checked' : ''; ?>
                            />
                            <label for="<?php echo $id; ?>"><?php echo $deadline['text']; ?></label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            <div class="page-filter__category">
            <a href="#housing" class="page-filter__category-link" data-toggle="collapse">
                <h3 class="page-title-h3">Класс жилья</h3>
                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z" fill="#111111" />
                </svg>
            </a>
            <?php $housing_terms = get_terms( [
                'taxonomy'      => 'housing',
                'hide_empty'    => false,
            ] ); ?>
            <?php if( $housing_terms && !is_wp_error( $housing_terms ) ) : ?>
                <div class="page-filter__category-list collapse show" id="housing">
                    <ul class="housing">
                        <?php foreach( $housing_terms as $term ) : ?>
                        <li>
                            <div class="checkbox">
                            <input type="checkbox"
                                name="housing-<?php echo $term->term_id; ?>"
                                id="housing-<?php echo $term->term_id; ?>"
                                data-term-id="<?php echo $term->term_id; ?>"
                                <?php echo in_array( $term->term_id, $housing_filter_args ) ? 'checked' : ''; ?>
                            />
                            <label for="housing-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            </div>
            <div class="page-filter__category">
            <a href="#general" class="page-filter__category-link" data-toggle="collapse">
                <h3 class="page-title-h3">Основные опции</h3>
                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z" fill="#111111" />
                </svg>
            </a>
            <div class="page-filter__category-list collapse show" id="general">
                <ul class="general">
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="yard" id="yard">
                    <label for="yard">Благоустроенный двор</label>
                    <span class="icon-garden"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="finishing" id="finishing">
                    <label for="finishing">Отделка под ключ</label>
                    <span class="icon-paint"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="parking" id="parking">
                    <label for="parking">Подземный паркинг</label>
                    <span class="icon-parking"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="brick" id="brick">
                    <label for="brick">Кирпичный дом</label>
                    <span class="icon-brick"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="river" id="river">
                    <label for="river">Вид на реку</label>
                    <span class="icon-water"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="forest" id="forest">
                    <label for="forest">Лес рядом</label>
                    <span class="icon-tree"></span>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="sale" id="sale">
                    <label for="sale">Есть акции</label>
                    <span class="icon-sale"></span>
                    </div>
                </li>
                </ul>
            </div>
            </div>
            <div class="page-filter__category">
            <a href="#additional" class="page-filter__category-link" data-toggle="collapse">
                <h3 class="page-title-h3">Дополнительные опции</h3>
                <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.036 0.611083L0.191897 6.45712C-0.0639745 6.71364 -0.0639745 7.12925 0.191897 7.38642C0.44777 7.64294 0.863375 7.64294 1.11925 7.38642L6.49964 2.00408L11.88 7.38577C12.1359 7.64229 12.5515 7.64229 12.808 7.38577C13.0639 7.12925 13.0639 6.713 12.808 6.45648L6.96399 0.610435C6.71076 0.357856 6.28863 0.357856 6.036 0.611083Z" fill="#111111" />
                </svg>
            </a>
            <div class="page-filter__category-list collapse show" id="additional">
                <ul class="additional">
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="without-cars" id="without-cars">
                    <label for="without-cars">Двор без машин</label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="ceiling" id="ceiling">
                    <label for="ceiling">Высокие потолки</label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="pantries" id="pantries">
                    <label for="pantries">Есть кладовые</label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="windows" id="windows">
                    <label for="windows">Панорамные окна</label>
                    </div>
                </li>
                <li>
                    <div class="checkbox">
                    <input type="checkbox" name="low-rise" id="low-rise">
                    <label for="low-rise">Малоэтажный (&lt;10 этажей)</label>
                    </div>
                </li>
                </ul>
                <div class="collapse" id="additional_collapse">
                <ul class="additional additional__collapse">
                    <li>
                    <div class="checkbox">
                        <input type="checkbox" name="windows-2" id="windows-2">
                        <label for="windows-2">Панорамные окна</label>
                    </div>
                    </li>
                    <li>
                    <div class="checkbox">
                        <input type="checkbox" name="low-rise-2" id="low-rise-2">
                        <label for="low-rise-2">Малоэтажный (&lt;10 этажей)</label>
                    </div>
                    </li>
                    <li>
                    <div class="checkbox">
                        <input type="checkbox" name="without-cars-2" id="without-cars-2">
                        <label for="without-cars-2">Двор без машин</label>
                    </div>
                    </li>
                    <li>
                    <div class="checkbox">
                        <input type="checkbox" name="ceiling-2" id="ceiling-2">
                        <label for="ceiling-2">Высокие потолки</label>
                    </div>
                    </li>
                    <li>
                    <div class="checkbox">
                        <input type="checkbox" name="pantries-2" id="pantries-2">
                        <label for="pantries-2">Есть кладовые</label>
                    </div>
                    </li>
                </ul>
                </div>
                <a href="#additional_collapse" class="page-filter__category-more" data-toggle="collapse" data-count="9" role="button">Показать еще (9)</a>
            </div>
            </div>
            <div class="page-filter__category service">
            <div class="checkbox">
                <input
                    type="checkbox"
                    name="service"
                    id="service"
                    <?php echo $is_service_checked ? 'checked' : ''; ?>
                />
                <label for="service">
                <span class="checkbox__box"></span>Услуги 0% </label>
                <span class="tip tip-info" data-toggle="popover" data-placement="top" data-content="And here's some amazing content. It's very engaging. Right?">
                <span class="icon-prompt"></span>
                </span>
            </div>
            </div>
        </div>
        <div class="page-filter__buttons">
            <button class="button button--pink w-100" type="submit" id="apply_filter">Применить фильтры</button>
            <button class="button w-100"
            <?php 
            // !!! type="reset". if we load checked, apply filter, and click reset
            // !!! checkboxes set to load state (page load, dom load)
            // !!! need manual reset for be right (right with filter params when page refresh (f5) e.t.c)
            ?>
            type="reset"
            id="reset_filter">Сбросить фильтры <svg width="9" height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.5 0.942702L7.5573 0L4.49999 3.05729L1.4427 0L0.5 0.942702L3.55729 3.99999L0.5 7.0573L1.4427 8L4.49999 4.94271L7.55728 8L8.49998 7.0573L5.44271 3.99999L8.5 0.942702Z" />
            </svg>
            </button>
        </div>
        </form>
    </div>
</div>