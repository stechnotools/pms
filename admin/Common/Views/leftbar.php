<ul class="side-nav">
	<?php foreach ($menus as $menu) { ?>
	<li class="<?php echo $menu['heading']?'side-nav-title':'side-nav-item';?>" id="<?php echo $menu['id']; ?>">
        <?php if($menu['heading']){?>
            <?php echo $menu['name']; ?>
        <?}else {?>
            <?php if ($menu['href'] && !$menu['children']) { ?>
            <a class="side-nav-link" href="<?php echo $menu['href']; ?>"><i class="<?php echo $menu['icon']; ?> "></i> <span class="sidebar-mini-hide"><?php echo $menu['name']; ?></span></a>
            <?php } else { ?>
            <a data-bs-toggle="collapse" href="#sidebar<?$menu['id']?>" aria-expanded="false" aria-controls="sidebar<?$menu['id']?>" class="side-nav-link" >
                <i class="<?php echo $menu['icon']; ?> "></i>
                <span><?php echo $menu['name']; ?></span>
                <?php if($menu['children']){?>
                    <span class="menu-arrow"></span>
                <?}?>
            </a>
            <?php } ?>
            <?php if ($menu['children']) { ?>
            <div class="collapse" id="sidebar<?$menu['id']?>">
                <ul class="side-nav-second-level" >
                <?php foreach ($menu['children'] as $children_1) { ?>
                <li>
                    <?php if ($children_1['href']) { ?>
                    <a href="<?php echo $children_1['href']; ?>"><?php echo $children_1['name']; ?></a>
                    <?php } else { ?>
                    <a class="<?php echo $children_1['children']?'nav-submenu':'';?>" data-toggle="<?php echo $children_1['children']?'nav-submenu':'';?>" href="#"><?php echo $children_1['name']; ?></a>
                    <?php } ?>
                    <?php if ($children_1['children']) { ?>
                    <ul>
                        <?php foreach ($children_1['children'] as $children_2) { ?>
                        <li>
                            <?php if ($children_2['href']) { ?>
                            <a href="<?php echo $children_2['href']; ?>"><?php echo $children_2['name']; ?></a>
                            <?php } else { ?>
                            <a class="parent waves-effect"><?php echo $children_2['name']; ?></a>
                            <?php } ?>
                            <?php if ($children_2['children']) { ?>
                            <ul>
                                <?php foreach ($children_2['children'] as $children_3) { ?>
                                <li><a href="<?php echo $children_3['href']; ?>"><?php echo $children_3['name']; ?></a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
            </div>
            <?php } ?>
        <?php } ?>
        </li>
	<?php } ?>
</ul>		
			 