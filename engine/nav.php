<div class="header">
    <header class="navigation">
        <div class="container-flex">
            <nav class="top-table">
                <ul>
                    <li class="logo">
                        <div>
                            <a class="mlogo" href="//enviosity.com">Enviosity</a>
                            <!--<a class="mdesc">The Couch Gaming</a>-->
                        </div>
                    </li>
                    <li tabindex="-1" class="top-table-icons menu">
                        <a class="dd-link "><i class="far fa-bars"></i><i class="fas"></i><i class="fal"></i></a>
                        <div class="dd-content">
                            <div class="dd-aligner">
                                <dl class="menu-nav">
                                    <dd class="tcg_"><a href="//enviosity.com/"><span><i class="fas fa-home"></i></span> Home</a></dd>
                                    <dd class="tcg_galery"><a href="//enviosity.com/galery/"><span><i class="fas fa-images"></i></span> Galery</a></dd>
                                </dl>
                            </div>
                            <div class="dd-container">
                                <div class="dd-tab tcg_">
                                    <dl>
                                        <dd><!--<a href="//enviosity.com/galery/"><span><i class="fal fa-images"></i></span> Galery</a>--></dd>
                                    </dl>
                                </div>
                                <!--<div class="dd-tab tcg_galery">
                                     <?php if($user['access']>=2){ ?>
                                    <dl>
                                        <dd><a href="//enviosity.com/galery/add/"><span><i class="fal fa-plus"></i></span> Add</a></dd>
                                    </dl>
                                    <?php } ?>-->
                                </div>
                            </div>
                        </div>
                    </li>
                <?php if($search){ ?>
                    <li tabindex="-1" class="top-table-fill search">
                        <div class="dd-search">
                            <input id="search" name="search" placeholder="<?=$search_ph?>" autocomplete="off">
                            <i class="far fa-search"></i>
                        </div>
                    </li>
                <?php }else{ ?>
                    <li tabindex="-1" class="top-table-fill disabled">
                        <p id="search" style="padding-bottom:0;text-align:center"><?=$search_ph?></p>
                    </li>
                <?php }
                if($user['access']>=1){ ?>
                    <li tabindex="-1" class="top-table-icons notice">
                        <a class="dd-link"><i class="far fa-bell"></i></a>
                        <div class="dd-content">
                            <div class="dd-notice">
                                <a>Notifications here!</a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                    <li tabindex="-1" class="top-table-icons user">
                        <a class="dd-link "><img class="avatar img-circle" src="//enviosity.com/galery/avatars/<?=$user['avatar'];?>"></a>
                        <div class="dd-content">
						<!
                        <?php if($user['access']>=1){ ?>
                            <div class="dd-profile">
                                <div class="dd-username"><?=$user["username"];?></div>
                                <div class="dd-email"><?=$user["email"];?></div>
                            </div>
                            <a href="//enviosity.com/user/<?=$user['username'];?>/"><span><i class="far fa-user"></i></span> Profile</a>
                            <a href="//enviosity.com/settings/"><span><i class="far fa-cog"></i></span> Settings</a>
                            <a href="//enviosity.com/logout/"><span><i class="far fa-sign-out"></i></span> Logout</a>
                        <?php }else{ ?>
                            <a href="#"><span><i class="far fa-sign-in"></i></span>Soon (going through redesign)</a>
                        <?php } ?>
                        </div>
                    </li>
                </ul>
            </nav>
            <i class="fas"></i> <!-- fix to load -->
        </div>
    </header>
</div>