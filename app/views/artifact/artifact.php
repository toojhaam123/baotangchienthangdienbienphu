<div class="row artifacts center mt-5 mb-3">
    <div class="row collapse" id="introduce_artifact">
        <div class="col-md-8">
            <p>Bảo tàng Chiến thắng Điện Biên Phủ lưu giữ hàng nghìn hiện vật có giá trị lịch sử, phản ánh những khoảnh khắc quan trọng trong trận chiến lịch sử Điện Biên Phủ.
                Các hiện vật này không chỉ là chứng nhân của lịch sử mà còn là minh chứng cho lòng dũng cảm và sức mạnh kiên cường của quân và dân Việt Nam trong cuộc chiến tranh vệ quốc.</p>
        </div>
        <div class="col-md-4 img-intro">
            <img src="./image/Sưu tầm lựu đạn.jpg" alt="">
        </div>
    </div>
    <div class="col-md-12 btn_tronduce text-center">
        <button class="btn border-0" id="btn_introduce" data-bs-toggle="collapse" data-bs-target="#introduce_artifact">
            Bấm để hiện giới thiệu</button>
        <div class="col-md-8" id="fake_conten"></div>
    </div>
    <!-- Danh sách hiện vật -->
    <div class="col-md-12 border-bottom text-center">
        <h4>Danh sách hiện vật</h4>
    </div>
    <div class="col-md-12">
        <form action="" method="post">
            <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
            <button type="submit" class="btn <?php echo isset($_POST['weapon']) ? 'btn-primary' : '' ?>" name="weapon">Vũ khí</button>
            <button type="submit" class="btn <?php echo isset($_POST['costume']) ? 'btn-primary' : '' ?>" name="costume">Trang phục</button>
            <button type="submit" class="btn <?php echo isset($_POST['document']) ? 'btn-primary' : '' ?>" name="document">Tài liệu</button>
            <button type="submit" class="btn <?php echo isset($_POST['picture']) ? 'btn-primary' : '' ?>" name="picture">Tranh ảnh</button>
            <button type="submit" class="btn <?php echo isset($_POST['equiment']) ? 'btn-primary' : '' ?>" name="equiment">Dụng cụ</button>
            <button type="submit" class="btn <?php echo isset($_POST['models']) ? 'btn-primary' : '' ?>" name="models">Mô hình</button>
        </form>
    </div>
    <?php
    $countId = 0;
    foreach ($artifacts as $artifact) {
        $countId += 1;
        if (isset($_POST['weapon'])) {
            if ($artifact['type'] == 'weapon') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>

                    </div>
                </div>
            <?php }
        } elseif (isset($_POST['costume'])) {
            if ($artifact['type'] == 'costume') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php   }
        } elseif (isset($_POST['document'])) {
            if ($artifact['type'] == 'document') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
        } elseif (isset($_POST['picture'])) {
            if ($artifact['type'] == 'picture') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
        } elseif (isset($_POST['equiment'])) {
            if ($artifact['type'] == 'equiment') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php  }
        } elseif (isset($_POST['models'])) {
            if ($artifact['type'] == 'models') { ?>
                <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1"><b><?php echo $artifact['name'] ?></b></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="col-md-4 col-lg-3 col-6 my-2 mt-3 d-flex justify-content-center">
                <div class="card">
                    <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                        <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                        <div class="card-text text-center">
                            <p class="pt-1"><b><?php echo mb_substr($artifact['name'], 0, 30) . '...'  ?></b></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
        <!-- Xem chi tiết hiện vật -->
        <div class="modal fade detail_artifact" id="detail_artifact<?php echo $countId ?>">
            <div class="modal-dialog modal-lg modal-custom-responsive">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Chi tiết hiện vật</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="col-md-12 border-bottom mb-3">
                        <h3 class="text-center"><?php echo $artifact['name'] ?></h3>
                        <div class="modal-body">
                            <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="<?php echo $artifact['name'] ?>">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <i><b>Ngày đăng: </b><?php echo $artifact['created_at'] ?></i>
                                </div>
                            </div>
                            <p><b>Mô tả: </b></p>
                            <p><?php echo nl2br(htmlspecialchars($artifact['description'])) ?></p>
                        </div>
                    </div>
                    <div class="comment">
                        <h5 class="ms-4"><i class='bx bxs-comment-detail'></i>Bình luận</h5>
                        <div class="col-12 text-center my-1">
                        </div>
                        <form action="" method="post">
                            <div class="col-12 text-center">
                                <textarea
                                    class="form-control form-comment" rows="3" cols="10" name="comment" id="comment"
                                    placeholder="<?php echo isset($errors['cmt']) ? $errors['cmt'] : 'Viết bình luận...' ?>"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?></textarea>
                            </div>
                            <?php
                            if (!isset($_SESSION['users'])) { ?>
                                <label class="form-label" for="fullname">Họ và tên</label>
                                <span>* <?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                                <input class="form-control" type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" name="commenter">
                            <?php }
                            ?>
                            <div class="modal-footer border-0">
                                <input type="hidden" name="object_id" value="<?php echo $artifact['artifact_id'] ?>">
                                <input type="hidden" name="object_type" value="artifact">
                                <button
                                    name="post_cmt" type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-md-12 border-bottom text-center w-50">
                            <h5>Các bình luận về hiện vật</h5>
                        </div>
                        <!-- Danh sách bình luận -->
                        <?php
                        foreach ($allCmt as $cmt) {
                            if ($cmt['object_id'] == $artifact['artifact_id']) { ?>
                                <div class="col-md-12 mt-3 created_at_cmt">
                                    <i class="float-end"><?php echo $cmt['created_at'] ?></i>
                                    <div class="list-comment text-dark">
                                        <h5><?php echo $cmt['commenter'] ?></h5>
                                        <p><?php echo $cmt['content'] ?></p>
                                    </div>
                                </div>
                        <?php   }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
</div>
<!-- Phân trang -->
<div class="container">
    <form method="post">
        <ul class="pagination justify-content-center">
            <?php
            if ($pageArtifact > 1) { ?>
                <li class="page-item">
                    <a href="?request=artifact&page=<?= $pageArtifact - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                </li>
            <?php }
            for ($i = 1; $i <= $totalPageArtifact; $i++) { ?>
                <li class="page-item">
                    <a href="?request=artifact&page=<?= $i ?>" class="page-link  <?= $i == $pageArtifact ? 'active_page' : '' ?>"><?= $i ?></a>
                </li>
            <?php }
            if ($pageArtifact < $totalPageArtifact) { ?>
                <li class="page-item">
                    <a href="?request=artifact&page=<?= $pageArtifact + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                </li>
            <?php }
            ?>
        </ul>
    </form>
</div>
<p class="text-center">----------Hết----------</p>