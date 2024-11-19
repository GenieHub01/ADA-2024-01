<?php
$year = date('y');
$month = date('m');
?>
</div>
    </div>
<section id="billing">
    
    <div class="billing-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3><strong>Billing</strong> Information</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                

                <form action="" method="post" id="payment-form">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="billing-purpose">Enter your <strong>payment details below</strong></p>
                            
                        </div>
                        <div class="col-md-5 form-col">
                            <span>1. Cards Accepted</span>
                            <div class="cards">
                                <div class="visa"></div>
                                <div class="mcard"></div>
                                <div class="amexp"></div>
                            </div>
                            <span>2. Card Details</span>
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" required>
                            <label for="last-name">Last Name</label>
                            <input  type="text" id="last-name" name="last-name" required>
                            <label for="card-number">Card Number</label>
                            <input type="text" data-stripe="number" name="number" maxlength="20" required>
                            <div class="desktop-only">
                                <p class="total">TOTAL: £</p>
                                <?php $this->widget('booster.widgets.TbSelect2', [
                                    'name' => 'plan_id',
                                    'data' => $items,
                                    'options' => [
                                        'width' => '70%',
                                    ],
                                ]); ?>
                                <p><b>
                                    * Use the drop down to choose a payment type, renewal or one off<br>
                                    **For the monlthy plan, please allow 3 months for the seo to take effect<br>
                                    *** Renewal packages can be cancelled at anytime
                                    </b></p>
                                <input class="submit-payment" type="submit" value="Submit Payment">
                                <div class="payment-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6 exp-date">
                            <div class="cvv-pic">
                                <img src="/images/cards.png" alt="card">
                            </div>
                            <label class="exp-cvv">
                                <input type="text" size="4" data-stripe="cvc" name="cvc" required>
                                <span>Code/CVV</span>
                            </label><br>
                            <!-- <p>Expiration Date</p> -->
                            <label class="exp-month">
                                <input min="1" max="12" type="number" value="<?= $month ?>"  data-stripe="exp-month" maxlength="2" name="exp-month" required>
                                <span>Month</span>
                            </label>
                            <label class="exp-year">
                                <input min="<?= $year ?>" max="<?= $year+10 ?>" type="number" value="<?= $year + 1 ?>" data-stripe="exp-year" maxlength="2" name="exp-year" required>
                                <span>Year</span>
                            </label>
                            <div class="mobile-only">
                                <p class="total">TOTAL: <?= Yii::app()->numberFormatter->format('#,##0.00', $this->advert->amount); ?> <?= Opay::CURRENCY; ?></p>
                                <input class="submit-payment" type="submit" value="Submit Payment">
                                <div class="payment-errors"></div>
                            </div>
                            <div class="security">
                                <a href="#"><img src="/images/ADA_back_ssl.png" alt="SSL Secure Connection"></a>
                                <a href="#"><img src="/images/ADA_back_100secure.png" alt="100% Secure Payment"></a>
                            </div>
                            
                        </div>

                    </div><!-- /.row  -->

                </form>

                <div class="billing-partners">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands01.jpg" alt="google partner">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands02.jpg" alt="raaj">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands03.jpg" alt="bing ads">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands04.jpg" alt="ambur radio">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands05.jpg" alt="comodo secure">
                    <img src="https://www.asiandirectoryapp.com/wp-content/uploads/2017/04/cont_brands06.jpg" alt="star plus">
                </div>

            </div>

        </div>

    </div>
</section>

<script>
    Stripe.setPublishableKey('<?= Yii::app()->params['stripe.public'] ?>');
    $(function() {
        $('.about-content').hide();
    });
</script>
