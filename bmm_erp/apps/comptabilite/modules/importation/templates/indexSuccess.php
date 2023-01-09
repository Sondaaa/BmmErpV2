<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-magic"></i> AJAX Wizard Form</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div class="wizard-nav wizard-nav-horizontal">
            <ul>
                <li class="current" data-wzd-id="wzd_zone_0" onclick="afficher('wzd_zone_0')"><span><i class="icol-accept"></i> Member Profile</span></li>
                <li data-wzd-id="wzd_zone_1" onclick="afficher('wzd_zone_1')"><span><i class="icol-delivery"></i> Membership Type</span></li>
                <li data-wzd-id="wzd_zone_2" onclick="afficher('wzd_zone_2')"><span><i class="icol-user"></i> Confirmation</span></li>
            </ul>
        </div>
        <form class="mws-form wzd-ajax wizard-form wizard-form-horizontal" novalidate="novalidate">

            <fieldset class="wizard-step mws-form-inline" data-wzd-id="wzd_zone_0" id='wzd_zone_0'>
                <legend class="wizard-label" style="display: none;"><i class="icol-accept"></i> Member Profile</legend>
                <div class="mws-form-row" id="">
                    <label class="mws-form-label">Fullname <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <input type="text" class="required large" name="fullname">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Email <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <input type="text" class="required email large" name="email">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Address <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <textarea class="required large" cols="" rows="" name="address"></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Gender <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <ul class="mws-form-list">
                            <li><input type="radio" class="required" name="gender" id="male"> <label for="male">Male</label></li>
                            <li><input type="radio" name="gender" id="female"> <label for="female">Female</label></li>
                        </ul>
                        <label for="gender" generated="true" class="error plain"></label>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step mws-form-inline" style="display: none;" data-wzd-id="wzd_zone_1" id='wzd_zone_1'>
                <legend class="wizard-label" style="display: none;"><i class="icol-delivery"></i> Membership Type</legend>
                <div class="mws-form-row" id="">
                    <label class="mws-form-label">Membership Plan <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <select class="required large">
                            <option>Free</option>
                            <option>Standard</option>
                            <option>Premium</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Subscription Period <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <select class="required large">
                            <option>One Month</option>
                            <option>Six Months</option>
                            <option>Twelve Months</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Payment Method <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <ul class="mws-form-list">
                            <li><input type="radio" class="required" name="pm" id="cc"> <label for="cc">Credit Card</label></li>
                            <li><input type="radio" name="pm" id="pp"> <label for="pp">PayPal</label></li>
                        </ul>
                        <label style="display:none" for="pm" generated="true" class="error plain"></label>
                    </div>
                </div>
            </fieldset>

            <fieldset class="wizard-step mws-form-inline" style="display: none;" data-wzd-id="wzd_zone_2" id="wzd_zone_2">
                <legend class="wizard-label" style="display: none;"><i class="icol-user"></i> Confirmation</legend>
                <div class="mws-form-row">
                    <label class="mws-form-label">Message <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <textarea class="required large" cols="" rows="" name="address"></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Subscribe Newsletter <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" class="required" name="sn" id="sn_yes"> <label for="sn_yes">Yes</label></li>
                            <li><input type="radio" name="sn" id="sn_no"> <label for="sn_no">No</label></li>
                        </ul>
                        <label style="display:none" for="sn" generated="true" class="error plain"></label>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">I agree to the TOS <span class="required">*</span></label>
                    <div class="mws-form-item">
                        <ul class="mws-form-list inline">
                            <li><input type="checkbox" class="required" name="tos" id="tos_y"> <label for="tos_y">Yes</label></li>
                        </ul>
                        <label style="display:none" for="tos" generated="true" class="error plain"></label>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script  type="text/javascript">

    function afficher(id) {
        $('fieldset').each(function() {
            if ($(this).attr('data-wzd-id') == id)
                $(this).css('display', '');
            else
                $(this).css('display', 'none');
        });
    }

</script>