<?php
    // General Settings
    $trackLoggedinUser = c::get('analytics.trackloggedinuser', false);

    // Google Analytics
    $ga     = c::get('analytics.google'             , false);
    $gaId   = c::get('analytics.google.id'          , false);
    $gaAnon = c::get('analytics.google.anonymizeip' , true);

    // Piwik
    $piwik    = c::get('analytics.piwik'     , false);
    $piwikUrl = c::get('analytics.piwik.url' , false);
    $piwikId  = c::get('analytics.piwik.id'  , false);

    // Open Webanalytics
    $owa    = c::get('analytics.owa'     , false);
    $owaUrl = c::get('analytics.owa.url' , false);
    $owaId  = c::get('analytics.owa.id'  , false);

    // Mixpanel
    $mix      = c::get('analytics.mix'       , false);
    $mixToken = c::get('analytics.mix.token' , false);

    // Honor Do Not Track Opt Out
    // <http://donottrack.us/>
    $honorDnt = c::get('analytics.dnt', true);

    // Do not track logged in users
    if ($trackLoggedinUser && site()->user()){
        return;
    }

    // Disabled on current page?
    if ($page->analyticsdisabled()->isTrue()){
        return;
    }

    // Check if "Do Not Track" Opt Out is set and enabled
    if ($honorDnt){
        if ( server::get("HTTP_" . strtoupper(str_replace("-", "_", "DNT")), 0) == 1 ) {
            // Do Not Track is enabled
            return;
        }
    }
?>
<?php if ($ga && $gaId): ?>
    <!-- Google Analytics -->
    <script>
        var gaProperty = '<?php echo $gaId; ?>';

        window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
        ga('create', gaProperty, 'auto');
        <?php if ($gaAnon): ?>
            ga('set', 'anonymizeIp', true);
        <?php endif; ?>
        ga('send','pageview');

        var disableStr = 'ga-disable-' + gaProperty;
        if (document.cookie.indexOf(disableStr + '=true') > -1) {
            window[disableStr] = true;
        }
        function gaOptout() {
            document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
            window[disableStr] = true;
            alert('Google Analytics Opt Out successfull!');
        }
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <!-- / Google Analytics -->
<?php endif; ?>

<?php if ($piwik && $piwikUrl && $piwikId): ?>
    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function () {
            var u = "//<?= $piwikUrl; ?>/";
            _paq.push(['setTrackerUrl', u + 'piwik.php']);
            _paq.push(['setSiteId', <?= $piwikId; ?>]);
            var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.defer = true;
            g.src = u + 'piwik.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <noscript><p><img src="//<?= $piwikUrl; ?>/piwik.php?idsite=<?= $piwikId; ?>" style="border:0;" alt=""/></p></noscript>
    <!-- / Piwik -->
<?php endif; ?>

<?php if ($owa && $owaUrl && $owaId): ?>
    <!-- Open Web Analytics -->
    <script type="text/javascript" src="<?php echo $owaUrl?>modules/base/js/owa.tracker-combined-min.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    OWA.setSetting('baseUrl', '<?php echo $owaUrl?>');
    OWATracker = new OWA.tracker();
    OWATracker.setSiteId('<?php echo $owaId?>');
    OWATracker.trackPageView();
    OWATracker.trackClicks();
    OWATracker.trackDomStream();
    //]]>
    </script>
    <!-- / Open Web Analytics -->
<?php endif; ?>

<?php if ($mix && $mixToken): ?>
    <!--  Mixpanel -->
    <script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
    0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
    for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
    mixpanel.init("<?php echo $mixToken?>");</script>
    <!-- / Mixpanel -->
<?php endif; ?>
