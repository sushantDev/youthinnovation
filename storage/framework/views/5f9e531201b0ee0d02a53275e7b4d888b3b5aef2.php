
<div class="" style="font-family: Montserrat;">
<footer class="footer" style="background-color: white">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="widget tw_rise_info-2">
                    <div class="widget_normal">

                        <div class="heading"><h4><contact1>Youth Innovation Lab</contact1></h4></div>
                        <p>The YI-Lab is a collaborative platform and experimental pop-up to catalyze and mobilize the creative energy of young people between 15-29 to co-create solutions for inclusive development.</p>

                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="widget tw_contact_info-2">
                    <div class="widget_contact">

                        <div class="heading"><h4><contact2> Contact Info</contact2></h4></div>
                        <ul>
                            <li class="address">96, Jana Marg, Bansbari,
                                Kathmandu, Nepal

                            </li>
                            
                            
                                
                            
                            
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="widget">

                    <div class="widget_contact_form">

                        <div class="heading"><h4><contact3>Any Questions? Drop us a Note</contact3></h4></div>
                        <div class="row">
                            <form class="contact-form" method="post" action="http://wow-themes.com/demo/wp/rise/wp-admin/admin-ajax.php?action=_sh_ajax_callback&amp;subaction=sh_contact_form_submit" id="rise_contact_form">
                                <div class="col-sm-6">


                                    <div class="msgs"></div>

                                    <input type="text" placeholder="Enter Name" class="form-control" name="contact_name">

                                    <input type="text" placeholder="Your Email" class="form-control" name="contact_email">

                                    <input type="text" placeholder="Subject" class="form-control" name="contact_subject">

                                </div>

                                <div class="col-sm-6">
                                    <textarea placeholder="Message" class="form-control" name="contact_message"></textarea>

                                    <input type="submit" value="Send Message" class="btn btn-primary btn-sm pull-right">
                                    <script>
                                        jQuery(document).ready(function ($) {
                                            $('#rise_contact_form').live('submit', function (e) {

                                                e.preventDefault();
                                                var thisform = this;
                                                var fields = $(this).serialize();
                                                var url = $(this).attr('action');
                                                //alert(url);
                                                $.ajax({
                                                    url: url,
                                                    type: 'POST',
                                                    data: fields,
                                                    success: function (res) {
                                                        //salert(res);
                                                        $('.msgs', thisform).html(res);
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="site-bottom">
    <div class="container">
        <p>Copyright © 2017 Youth Innovation.</p>
        <ul class="social-links">
            <li>
                <a href="#" class="" data-placement="top" data-toggle="tooltip" title=""></a>
            </li>

            <li>
                <a href="#" class="" data-placement="top" data-toggle="tooltip" title=""></a>
            </li>

        </ul>
    </div>
</div>
</div>
