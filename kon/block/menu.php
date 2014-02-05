<div id="container">
    <div id="menu_pane">
        <div id="menu">
            <ul class="sf-menu">
                <li class="current"><a href="../index.php">Главная</a>
                    <?php $name = "main"; submenuAdd($name);?>
                </li>
                <li class="current"><a href="../pologenie.php">Положение о Cовете</a>
                    <?php $name = "pologenie"; submenuAdd($name);?>
                </li>
                <li class="current"><a href="../protocol.php">Протоколы Cовета</a>
                    <?php $name = "protocol"; submenuAdd($name);?>
                </li>
                <li class="current"><a href="../plans.php">Планы Cовета</a>
                    <?php $name = "plans"; submenuAdd($name);?>
                </li>
                <li class="current"><a href="../rsrinfo.php">Информация РСР</a>
                    <?php $name = "rsrinfo"; submenuAdd($name);?>
                </li>
                <li class="current"><a href="#">Галерея</a>
                    <?php galleryAdd(); ?>
                </li>
                <li class="current"><a href="../sostav.php">Состав Cовета</a>
                    <?php $name = "sostav"; submenuAdd($name);?>
                </li>
            </ul>
        </div>
    </div><br />