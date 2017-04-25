<div class="col-sm-11 container">
    <div id="contact">
        <div class="row row-max">
            <div class="col-xs-12">
                <div class="row">
                <h1 class="text-center">Հետադարձ կապ</h1>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="row row-max">
                        <div class="form-container">
                            <form method="post" role="form" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select class="form-control" name="theme">
                                        <?php if (!empty($contact_topic)) {?>
                                            <?php foreach ($contact_topic as $item) {?>
                                                <option value="<?php echo $item->title; ?>"><?php echo $item->title; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Խնդրում ենք հնարավորինս մանրամասն ներկայացնել հարցը: Ավելի մանրամասն տեղեկություննը կօգնի պատասխանել Ձեր հարցին հնարավորինս սեղմ ժամանակահատվածում: Դուք կարող եք տրամադրել նաև էկրանի նկարով ֆայլ:</label>
                                    <textarea class="form-control" placeholder="Գրեք հարցը" cols="1" rows="5" name="question"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" multiple="multiple" placeholder="Ընտրել ֆայլը" name="file[]" accept="application/msword, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Անուն, Ազգանուն, Հայրանուն" name="name" maxlength="255" value="">
                                </div>
                                <div class="form-group">
                                    <p>Ցանկանում եք Ձեզ զանգահարի մեր մենջերը?</p>
                                    <label class="radio-inline"><input type="radio" name="call">Այո</label>
                                    <label class="radio-inline"><input type="radio" name="call">Ոչ</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Լրացրեք հեռախոսահամարը" name="phone" maxlength="255" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Լրացրեք էլ. հասցեն" name="email" maxlength="255" value="">
                                </div>

    <!--                            <div class="form-group">-->
    <!--                                <p class="text-center">-->
    <!--                                    <img alt="" title="" src="/images/custom/10b0ca6294.gif" width="150">-->
    <!--                                </p>-->
    <!---->
    <!--                                <input type="text" class="form-control" placeholder="Введите код с картинки" name="capcha" maxlength="6" value="">-->
    <!--                            </div>-->

                                <div class="text-center">
                                    <input type="submit" name="send" value="Ուղարկել">
                                </div>
                            </form>
                        </div>            </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <?if(!empty($contact)) { ?>
                        <h2 class="text-center"><?php echo $contact['content']; ?></h2>
                        <div class="text-center">
                            <img height="300" src="<?php echo $this->config->item('images_path') . "contact/" . $contact['image']?>"
                        </div>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>