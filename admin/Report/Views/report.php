<?php
$user=service('user');
?>
<!-- Simple Text Tiles -->
<h2 class="content-heading">All Reports</h2>
<div class="row gutters-tiny">
    <?php if($user->hasPermission('report/tentativefarmer')){?>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="<?=admin_url('report/tentativefarmer')?>">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Abstract Farmer</h5>
                </div>
            </div>
        </a>
    </div>
    <?}?>
    <?php if($user->hasPermission('report/ctentativefarmer')){?>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Castewise Farmer</h5>
                </div>
            </div>
        </a>
    </div>
    <?}?>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-elegance ribbon-crystal">
                <div class="ribbon-box">
                    G
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Mapwise Farmer</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Monthwise W-Fieldvisit</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-elegance ribbon-crystal">
                <div class="ribbon-box">
                    G
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Designation W-Fieldvisit</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Monthwise B-Fieldvisit</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-elegance ribbon-crystal">
                <div class="ribbon-box">
                    G
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Designation B-Fieldvisit</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Abstract Trackingsheet</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-flat ribbon-crystal">
                <div class="ribbon-box">
                    T
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">Detailed Trackingsheet</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 col-xl-3">
        <a class="block block-link-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full ribbon ribbon-bookmark bg-elegance ribbon-crystal">
                <div class="ribbon-box">
                    G
                </div>
                <div class="text-center py-30">
                    <h5 class="font-w700 text-white mb-0">District Trackingsheet</h5>
                </div>
            </div>
        </a>
    </div>

</div>




                