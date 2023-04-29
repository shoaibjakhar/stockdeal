<!DOCTYPE html>
<html>
<head>
    <title>Share Idea</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="signature.js"></script>

    <style>
        .kbw-signature {
         width: 200px;
         height: 100px;
         border:black solid 1px; 
     }
     #sig canvas{
        width: 100% !important;
        height: auto;
    }
    body{
        /*background-color:#bdbfbd;*/
    }
</style>

<!-- letter text -->

<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        text-indent: 0;
    }
    
    .s1 {
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10pt;
    }
    
    h1 {
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: underline;
        font-size: 10pt;
    }
    
    .p,
    p {
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
        margin: 0pt;
    }
    
    .s2 {
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: underline;
        font-size: 10pt;
    }
    
    .s3 {
        color: black;
        font-family: Cambria, serif;
        font-style: italic;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    li {
        display: block;
    }
    
    #l1 {
        padding-left: 0pt;
        counter-reset: c1 1;
    }
    
    #l1> li>*:first-child:before {
        counter-increment: c1;
        content: counter(c1, upper-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l1> li:first-child>*:first-child:before {
        counter-increment: c1 0;
    }
    
    li {
        display: block;
    }
    
    #l2 {
        padding-left: 0pt;
        counter-reset: d1 1;
    }
    
    #l2> li>*:first-child:before {
        counter-increment: d1;
        content: counter(d1, decimal)". ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l2> li:first-child>*:first-child:before {
        counter-increment: d1 0;
    }
    
    #l3 {
        padding-left: 0pt;
        counter-reset: d2 1;
    }
    
    #l3> li>*:first-child:before {
        counter-increment: d2;
        content: counter(d2, lower-latin)".) ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l3> li:first-child>*:first-child:before {
        counter-increment: d2 0;
    }
    
    li {
        display: block;
    }
    
    #l4 {
        padding-left: 0pt;
        counter-reset: e1 1;
    }
    
    #l4> li>*:first-child:before {
        counter-increment: e1;
        content: counter(e1, upper-latin)".) ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l4> li:first-child>*:first-child:before {
        counter-increment: e1 0;
    }
    
    #l5 {
        padding-left: 0pt;
        counter-reset: e2 1;
    }
    
    #l5> li>*:first-child:before {
        counter-increment: e2;
        content: counter(e2, decimal)". ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l5> li:first-child>*:first-child:before {
        counter-increment: e2 0;
    }
    
    #l6 {
        padding-left: 0pt;
        counter-reset: e2 1;
    }
    
    #l6> li>*:first-child:before {
        counter-increment: e2;
        content: counter(e2, decimal)". ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l6> li:first-child>*:first-child:before {
        counter-increment: e2 0;
    }
    
    #l7 {
        padding-left: 0pt;
        counter-reset: e3 2;
    }
    
    #l7> li>*:first-child:before {
        counter-increment: e3;
        content: counter(e3, lower-latin)". ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l7> li:first-child>*:first-child:before {
        counter-increment: e3 0;
    }
    
    li {
        display: block;
    }
    
    #l8 {
        padding-left: 0pt;
        counter-reset: f1 10;
    }
    
    #l8> li>*:first-child:before {
        counter-increment: f1;
        content: counter(f1, upper-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l8> li:first-child>*:first-child:before {
        counter-increment: f1 0;
    }
    
    #l9 {
        padding-left: 0pt;
        counter-reset: f2 1;
    }
    
    #l9> li>*:first-child:before {
        counter-increment: f2;
        content: counter(f2, decimal)". ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l9> li:first-child>*:first-child:before {
        counter-increment: f2 0;
    }
    
    #l10 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l10> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l10> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l11 {
        padding-left: 0pt;
        counter-reset: f4 1;
    }
    
    #l11> li>*:first-child:before {
        counter-increment: f4;
        content: counter(f4, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l11> li:first-child>*:first-child:before {
        counter-increment: f4 0;
    }
    
    #l12 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l12> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l12> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l13 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l13> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l13> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l14 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l14> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l14> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l15 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l15> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l15> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l16 {
        padding-left: 0pt;
        counter-reset: g1 1;
    }
    
    #l16> li>*:first-child:before {
        counter-increment: g1;
        content: counter(g1, lower-latin)".) ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l16> li:first-child>*:first-child:before {
        counter-increment: g1 0;
    }
    
    #l17 {
        padding-left: 0pt;
        counter-reset: h1 1;
    }
    
    #l17> li>*:first-child:before {
        counter-increment: h1;
        content: counter(h1, lower-latin)".) ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l17> li:first-child>*:first-child:before {
        counter-increment: h1 0;
    }
    
    #l18 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l18> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l18> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l19 {
        padding-left: 0pt;
        counter-reset: f4 1;
    }
    
    #l19> li>*:first-child:before {
        counter-increment: f4;
        content: counter(f4, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l19> li:first-child>*:first-child:before {
        counter-increment: f4 0;
    }
    
    #l20 {
        padding-left: 0pt;
        counter-reset: i1 4;
    }
    
    #l20> li>*:first-child:before {
        counter-increment: i1;
        content: counter(i1, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l20> li:first-child>*:first-child:before {
        counter-increment: i1 0;
    }
    
    #l21 {
        padding-left: 0pt;
        counter-reset: j1 6;
    }
    
    #l21> li>*:first-child:before {
        counter-increment: j1;
        content: counter(j1, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l21> li:first-child>*:first-child:before {
        counter-increment: j1 0;
    }
    
    #l22 {
        padding-left: 0pt;
        counter-reset: f4 1;
    }
    
    #l22> li>*:first-child:before {
        counter-increment: f4;
        content: counter(f4, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l22> li:first-child>*:first-child:before {
        counter-increment: f4 0;
    }
    
    #l23 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l23> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l23> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l24 {
        padding-left: 0pt;
        counter-reset: f4 1;
    }
    
    #l24> li>*:first-child:before {
        counter-increment: f4;
        content: counter(f4, lower-latin)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l24> li:first-child>*:first-child:before {
        counter-increment: f4 0;
    }
    
    #l25 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l25> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l25> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l26 {
        padding-left: 0pt;
        counter-reset: k1 1;
    }
    
    #l26> li>*:first-child:before {
        counter-increment: k1;
        content: counter(k1, lower-latin)".) ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: underline;
        font-size: 10pt;
    }
    
    #l26> li:first-child>*:first-child:before {
        counter-increment: k1 0;
    }
    
    #l27 {
        padding-left: 0pt;
        counter-reset: k2 1;
    }
    
    #l27> li>*:first-child:before {
        counter-increment: k2;
        content: "("counter(k2, lower-roman)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l27> li:first-child>*:first-child:before {
        counter-increment: k2 0;
    }
    
    #l28 {
        padding-left: 0pt;
        counter-reset: k2 1;
    }
    
    #l28> li>*:first-child:before {
        counter-increment: k2;
        content: "("counter(k2, lower-roman)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l28> li:first-child>*:first-child:before {
        counter-increment: k2 0;
    }
    
    #l29 {
        padding-left: 0pt;
        counter-reset: k2 1;
    }
    
    #l29> li>*:first-child:before {
        counter-increment: k2;
        content: "("counter(k2, lower-roman)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l29> li:first-child>*:first-child:before {
        counter-increment: k2 0;
    }
    
    #l30 {
        padding-left: 0pt;
        counter-reset: k3 6;
    }
    
    #l30> li>*:first-child:before {
        counter-increment: k3;
        content: "("counter(k3, lower-roman)") ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l30> li:first-child>*:first-child:before {
        counter-increment: k3 0;
    }
    
    #l31 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l31> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l31> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    
    #l32 {
        padding-left: 0pt;
        counter-reset: f3 1;
    }
    
    #l32> li>*:first-child:before {
        counter-increment: f3;
        content: counter(f2, decimal)"."counter(f3, decimal)" ";
        color: black;
        font-family: Cambria, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
    }
    
    #l32> li:first-child>*:first-child:before {
        counter-increment: f3 0;
    }
    </style>

    <!-- Ends letter text here -->

</head>
<body>

    <div class="container" style="border-left: 5px solid #00aeef">
        <div class="container" style="border-left: 5px solid #bbbdc0">
            <div id="content_holder">
            <div id="ele1" class="a" style="border-left: 5px solid #00aeef">

                <div style="text-align: center;">

                    <img src="https://management.shareidea.co.in/images/RSI-Login-Logo.png">
                    <h3 style="color: #6498d8">Rupa solitaire office no 902 Millennium business park Navi Mumbai mahape 400710</h3>

                </div>
            <hr>



               <div class="container">
                    <p style="text-indent: 0pt;text-align: left;">
                    <br/>
                    </p>
                    <p class="s1" style="padding-top: 5pt;padding-left: 309pt;text-indent: 0pt;text-align: left;">EMPLOYMENT OFFER LETTER &amp; AGREEMENT.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p class="s1" style="text-indent: 0pt;text-align: right;"><a name="bookmark0">Date:{{date}}</a></p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <h1 style="text-indent: 0pt;text-align: center;">Confidential</h1>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 6pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Dear : <u>{{full_name}}</u></p>
                    <p style="padding-left: 6pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Pursuant to our discussions, we are pleased to offer you employment opportunity, on probation basis, with</p>
                    <p class="s3" style="padding-left: 6pt;text-indent: 0pt;text-align: left;">(Share Idea) <span class="p">(&#39;</span>(Share Idea)<span class="p">&#39; or </span>Share Idea<span class="p">) starting from</span></p>
                    <p class="s2" style="padding-left: 6pt;text-indent: 0pt;text-align: left;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="p">(or such other date as may be communicated to you by the Company), as per details given below.</span></p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l1">
                        <li data-list-text="A)">
                            <p style="padding-left: 135pt;text-indent: -12pt;text-align: left;">Your current designation will be : {{Address}}<u> </u>.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="B)">
                            <p style="padding-top: 5pt;padding-left: 132pt;text-indent: -18pt;text-align: left;">You will be required to work at the Company&#39;s offices in location Navi Mumbai or anywhere in India, based on the company&#39;s needs &amp; requirements.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="C)">
                            <p style="padding-left: 132pt;text-indent: -17pt;text-align: justify;">Your all-inclusive annual target compensation (on a cost to company basis) will be INR (<u> </u>) which would comprise</p>
                        </li>
                    </ol>
                    <p style="padding-left: 139pt;text-indent: 4pt;text-align: justify;">your salary, applicable statutory benefits, bonus, if any, and/or any incentives as applicable to you. Your compensation shall be paid on a monthly basis, in arrears. The Company shall deduct tax at source at the time of making payment.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">The breakup of your all-inclusive annual target compensation is a</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p class="s1" style="padding-left: 6pt;text-indent: 0pt;text-align: left;"><a name="bookmark1">Name : </a><u> {{full_name}} </u><span class="p">.</span></p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p class="s1" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Position : <u> {{Position}} </u>_.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Total Cost to Company (CTC) : <u>Rs
 {{salry}} </u>.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">Notes:</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l2">
                        <li data-list-text="1.">
                            <p style="padding-top: 4pt;padding-left: 52pt;text-indent: -9pt;text-align: left;">The payroll processing will be as per Company policy notified from time to time.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="2.">
                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">Employees should decide on the Other Allowances and Reimbursements (OAAR) at the time of joining; any changes will be accepted as per Company policy applicable from time to time.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="3.">
                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">For claiming tax benefit in case of admissible allowances and reimbursements (eg. LTA, telephone etc.), you will have to submit supporting (bills) to the Company&#39;s satisfaction along with the</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: left;">reimbursement claim form in the prescribed format and within the timeline stipulated by the Company. The reimbursements will be processed as per the applicable</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Company&#39;s policies, which are subject to change without notice. The payments described above will not be further grossed up for taxes and you will be responsible for the payment of all taxes due with respect to such payments, which will be deducted at source as per the applicable law. In case of any under-withholding, you shall be responsible to pay the necessary tax and any interest/penalty thereon.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="4.">
                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">In cases where Permanent Account Number (PAN) is not produced, highest tax rates will apply to all amounts on which tax is deductible at source under the applicable tax law.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="5.">
                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">The Company reserves the right to change the compensation structure and/or the compensation components from time to time.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-top: 9pt;padding-left: 6pt;text-indent: 0pt;text-align: justify;">++ These statutory payments are included based on current applicable practice and law and are subject to changes based on changes in law from time to time. Also, please further note, that any changes /modification to statutory payments, due to change and/or amendment in law, shall not be treated as change in service condition(s) and therefore no notice of such change will be provided to you. However, the Company shall endeavor to inform you, via separate email communication or WhatsApp, about any changes/ modification to statutory payment.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: justify;">** This is the maximum limit you are eligible for. You may choose any of the following optional components under &#39;Other Allowance &amp; Reimbursements&#39; Non Taxable components (except Meal Coupons) would be paid based on a claim by employee through payroll. Taxable components would be paid on a monthly basis. All payments will be based on the Company&#39;s policies.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: left;"><a name="bookmark2">NOTE</a><span class="p">:</span></h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l3">
                                <li data-list-text="a.)">
                                    <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">All statutory payments are demonstrated based on current applicable practice and law and may be subject to changes based on changes in law from time to time. Further, any changes/modification to statutory payments, due to change and/or amendment in law, shall not be treated as change in service condition(s) and therefore no notice of such</p>
                                    <p style="padding-top: 1pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">change will be provided to you. However, Company shall endeavor to inform you, via separate communication, about any changes/modification to statutory payment.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="b.)">
                                    <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">As an employee of the Company, you shall be entitled to the following benefits subject to any change made by the Company from time to time:</p>
                                </li>
                            </ol>
                        </li>
                    </ol>
                    <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">c. Annual Leave/Public Holidays- You will be eligible for annual leaves and public holidays as determined by the Company&#39;s Leave Policy which is subject to change from time to time. If you become indebted to the Company for any reason, the Company may, if it so elects, set off any sum due to the Company from you against the compensation payable to you and collect any remaining balance from you.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l4">
                        <li data-list-text="A.)">
                            <h1 style="padding-top: 5pt;padding-left: 19pt;text-indent: -13pt;text-align: justify;"><a name="bookmark3">Probationary Period:</a></h1>
                            <ol id="l5">
                                <li data-list-text="1.">
                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You will be on probation for a period of 6 months from your date of joining the Company and continuity of your employment with the Company is dependent on confirmation of your employment. The Company reserves the right to revise the probation period depending on your performance and/or other consideration.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                                <li data-list-text="2.">
                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">At any time during your probation period the Company may confirm your employment by way of a written communication, if your performance is found to be satisfactory. Your probation shall be deemed extended, for a period not exceeding 30 days, in a situation where you do not receive the aforesaid written communication from the Company.</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                </li>
                            </ol>
                        </li>
                        <li data-list-text="B.)">
                            <h1 style="padding-left: 20pt;text-indent: -13pt;text-align: justify;"><a name="bookmark4">Performance Review:</a></h1>
                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">You will be eligible to participate in the Company&#39;s performance review process as per Company policy.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                        </li>
                        <li data-list-text="C.)">
                            <h1 style="padding-left: 19pt;text-indent: -13pt;text-align: justify;"><a name="bookmark5">Conditions of hire:</a></h1>
                            <ol id="l6">
                                <li data-list-text="1.">
                                    <p style="padding-left: 89pt;text-indent: -45pt;text-align: left;">Your employment with the Company will be subject to the following pre-conditions: a. You will submit relevant documents as mandated by the Company;</p>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l7">
                                        <li data-list-text="b.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">You obtain requisite certification or complete mandated assessments which are basis for offering you employment opportunity with the Company;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="c.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You obtain a clear discharge and/or relieving letter from your most recent employer (prior to joining the Company). Nevertheless, you must submit a clear discharge and/or relieving letter within fifteen (15) days of joining the Company;</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="d.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You represent that acceptance of employment with the Company does not breach any terms/provisions of your previous employment agreement or any other agreement to which you are bound.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="e.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You acknowledge that the Company has offered you employment based on the fact that there are no pending claims, actions, suits or proceedings against you which might reasonably be expected to have an adverse effect on your ability to perform your duties hereunder and/or upon the Company.</p>
                                        </li>
                                        <li data-list-text="f.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You provide two satisfactory references, one being from your most recent employer (prior to joining <i>(Share Idea)</i><b>;</b></p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="g.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">Your background verification check (including address, academics, employment, criminal etc as applicable) conducted by the Company is cleared; and</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="h.">
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">You represent that you have not been involved in any fraud, unethical and/or immoral acts, departmental inquiry in your previous employment(s) and/or been part of any pending investigation (whether judicial, quasi-judicial or otherwise) which you have not disclosed from the Company prior to your joining.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="2.">
                                    <p style="padding-top: 5pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">Your employment is inter alia based on the information furnished by you to the Company including declarations and undertakings thereto. If at any time during your employment with the Company, the Company discovers that you have furnished any false, fake, forged information (including documentation) for securing employment with the Company or otherwise, the Company reserves the right to take disciplinary action against you, including, but not limited to, right to terminate your employment without notice and your employment with the Company will be void ab-initio.</p>
                                </li>
                            </ol>
                        </li>
                    </ol>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <p style="padding-left: 60pt;text-indent: -36pt;text-align: left;">I) Your employment with the Company will also be governed by the terms and conditions of employment contained in <b>Exhibit 1 </b>attached hereto.</p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <ol id="l8">
                        <li data-list-text="J)">
                            <p style="padding-left: 42pt;text-indent: -34pt;line-height: 199%;text-align: left;">The Company&#39;s address for sending notice in relation to your employment is as below: Kind Attn: Head - Human Resources.</p>
                            <p class="s1" style="padding-top: 2pt;padding-left: 42pt;text-indent: 0pt;text-align: left;"><a name="bookmark6">Address: {{Address}}</a></p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p class="s1" style="padding-left: 42pt;text-indent: 0pt;text-align: left;">Email: {{Email}}</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: justify;">You are required to treat this letter and its contents as strictly confidential and should not disclose the same to any person or entity (except to your advisors, attorneys and accountants, for seeking their advice) without our prior written consent.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: justify;">At <i>(Share Idea)</i>, one of our goals is to afford all our people the opportunity to pursue their careers, to achieve their personal best, and to balance their personal and professional goals. <i>(Share Idea) </i>values your abilities and believes it can provide you with an atmosphere in which you can develop your professional talents to the fullest.</p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: justify;">As a token of your acceptance of our offer of employment with the Company, please sign in the space provided below and return a duplication version of this letter immediately to us within fifteen (15) days from the date of this letter. Our offer shall automatically lapse unless.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 18pt;line-height: 198%;text-align: left;">(i) you confirm your acceptance of it and return a copy to us within the prescribed time and (ii) you join us on or before your date of joining stated in this Employment Offer Letter. <b>For </b><i>(Share Idea)</i></p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 8pt;text-indent: 0pt;text-align: justify;">HR/ADMIN –</p>
                            <p class="s1" style="padding-top: 4pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"><a name="bookmark7">A</a><u>cceptance:</u></p>
                            <p style="padding-top: 4pt;padding-left: 6pt;text-indent: 35pt;text-align: justify;">I have read and understood the contents of this Employment Offer Letter and Exhibits hereto (hereinafter &#39;Letter &#39;) and accept all the terms and conditions of this Letter in its totality. I confirm that there are no other oral/written understandings other than as detailed herein between me and <i>(Share Idea)</i></p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">This Letter supersedes all previous agreements (written or oral) between the parties in relation to the subject matter. I confirm that I am not breaching any terms or provisions of any prior agreement or arrangement by accepting this offer.</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">(Employee Name and Signature below):</p>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p style="padding-left: 5pt;text-indent: 0pt;line-height: 1pt;text-align: left;" />
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <p class="s1" style="padding-left: 6pt;text-indent: 0pt;text-align: left;"><a name="bookmark8">Date:</a></p>
                            <h1 style="padding-left: 6pt;text-indent: 0pt;text-align: left;">EXHIBIT 1</h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <h1 style="padding-top: 4pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Terms &amp; Conditions of Employment with <i>(Share Idea)</i></h1>
                            <p style="text-indent: 0pt;text-align: left;">
                                <br/>
                            </p>
                            <ol id="l9">
                                <li data-list-text="1.">
                                    <h1 style="padding-top: 4pt;padding-left: 35pt;text-indent: -10pt;text-align: left;"><a name="bookmark9">CURRENT WORK LOCATION:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l10">
                                        <li data-list-text="1.1">
                                            <p class="s3" style="padding-top: 5pt;padding-left: 59pt;text-indent: -16pt;text-align: justify;">(Share Idea) <b>(&#39;&#39;</b>(Share Idea)<b>&#39;&#39; or &#39;&#39; </b>Share Idea <b>&#39;&#39;) </b><span class="p">may require you</span></p>
                                            <p style="padding-left: 60pt;text-indent: 0pt;text-align: justify;">to work at other Company locations and/or on customers&#39; sites both, within or outside India. The Company shall seek to give you reasonable notice of extensive travel requirements, and to take into accountyour personal circumstances where appropriate.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="1.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Depending upon exigencies of business you may be transferred/deputed, at Company&#39;s sole discretion, within India or outside by the Company in any capacity as the Company may desire from time to time, from:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l11">
                                                <li data-list-text="a)">
                                                    <p style="padding-left: 89pt;text-indent: -10pt;text-align: left;">one location to another; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b)">
                                                    <p style="padding-left: 89pt;text-indent: -11pt;text-align: left;">one team/department/account/function/Business Unit to another; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="c)">
                                                    <p style="padding-left: 89pt;text-indent: -10pt;text-align: left;">one project/job to another; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="d)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">the Company to any other group entity or affiliate or any other business associate as the Company may deem appropriate from time to time.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="1.3">
                                            <p style="padding-left: 78pt;text-indent: -35pt;text-align: justify;">Such transfer/deputation/assignment/relocation shall not entitle you to ask for revision in your salary or any terms or conditions of your service. The Company does not guarantee the continuation of any benefits or perquisite at the new location. In all such cases of transfer/deputation/assignment/relocation you will be governed by the relocation policies and policies of the Company existing at that time.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 5pt;padding-left: 78pt;text-indent: 0pt;text-align: justify;">Consequent to such transfer/deputation/assignment/relocation, you will be governed by the terms and conditions of service as applicable to your category of employees in the new location (which includes but is not limited to office days/hours and holidays).</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="2.">
                                    <h1 style="padding-top: 9pt;padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark10">DUTIES AND RESPONSIBILITIES:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l12">
                                        <li data-list-text="2.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">You shall devote your skill, knowledge and working time to the conscientious performance of your duties and responsibilities towards the Company. You shall perform your duties with diligence, devotion and discretion. You shall comply with all directions given to you by your reporting manager/supervisor and shall faithfully observe all the rules, regulations and Company policies. Further, the Company may, at any time, in its sole discretion, suitably modify your roles, responsibilities and duties.</p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="3.">
                                    <h1 style="padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark11">COMPENSATION:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l13">
                                        <li data-list-text="3.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: left;">Your all-inclusive annual target compensation and corresponding details are provided in the Employment offer letter.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="4.">
                                    <h1 style="padding-left: 16pt;text-indent: -10pt;text-align: left;"><a name="bookmark12">TRAINING: (IF U PROVIDE ANY)</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l14">
                                        <li data-list-text="4.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">During the term of your employment, the Company may offer you an opportunity to undergo certain specialized training, certification and/or skill up-gradation from time to time, which shall inter alia enhance your career opportunities at the Company and otherwise. In case you accept the Company&#39;s offer for training, the Company is likely to incur expenses including in relation to training costs, course fees, recruitment and induction costs, salary and benefits during training period, opportunity loss, etc. Depending on the nature of training/certification and corresponding cost and expenses, the Company may require you to</p>
                                            <p style="padding-top: 1pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">execute training agreement with the Company for a specific period (which will be indicated to you at that time) in consideration of the cost</p>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">the Company would be incurring for such training/certification. Under such training agreement, you shall agree to inter alia serve a minimum term of employment with the Company, failing which you will be required to reimburse the Company for the cost of training/certification identified in the training agreement and any other costs related to the training/certification.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="5.">
                                    <h1 style="padding-top: 9pt;padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark13">COVENANTS AND REPRESENTATIONS:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l15">
                                        <li data-list-text="5.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">You also agree that during the term of your employment with the Company and for twelve (12) months after the cessation of employment, regardless of the reason of cessation of employment, you will not:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l16">
                                                <li data-list-text="a.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">directly or indirectly, on your own behalf or on behalf of or in conjunction with any person or legal entity, recruit, hire, solicit, or induce, or attempt to recruit, hire, solicit, or induce, any employee of the Company with whom you had dealings, personal contact or supervised while</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                    <p style="padding-top: 4pt;padding-left: 78pt;text-indent: 0pt;text-align: left;">performing your duties or otherwise, to terminate their employment relationship with the Company;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">directly or indirectly, solicit or attempt to solicit business, customers or suppliers of the Company or of its affiliates;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="c.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">directly or indirectly, solicit or attempt to solicit or undertake employment with any client of the Company or any organization where you have been taken or sent for training, deputation or secondment or professional work by the Company; and</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="d.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">provide or attempt to provide professional services similar to those provided by the Company to its current or prospective customers, with whom you (i) had business interactions or any other dealings on behalf of the Company during your employment with the</p>
                                                </li>
                                            </ol>
                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">Company and/or (ii) had been directly associated with the customer in relation to the company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You and the Company acknowledge and agree that the duration and scope of the Covenants contained herein are fair and reasonable. Accordingly, you and the Company agree that, in the event that any of the covenants contained herein are nevertheless determined by a judicial or quasi-judicial body to be unenforceable because of the duration or scope thereof, the judicial or quasi-judicial body making such determination may reduce such duration and/or scope to the extent necessary to enable such judicial or quasi-judicial body to determine that such covenant is reasonable and enforceable, and to enforce such covenant as so amended.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You will also be governed by all applicable rules, processes, procedures, and policies (including but not limited to just internal policies and procedures, Code of Business Ethics of the Company, which are not specifically mentioned in this Letter. The applicable rules/processes/procedures/policies are available with HR, ADMIN, OPERATION HEAD &amp; PROPRIETOR OR DIRECTOR for your perusal and you are expected to go through the same carefully.</p>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">For any clarification in relation to applicable rules/processes/procedures/policies, please get in touch with concerned department. If at any time during your employment with the Company, you are found in violation of any applicable rules, processes, procedures, or policies of the Company, the Company reserves the right to take disciplinary action against you, including right to terminate your employment without notice.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.4">
                                            <p class="s3" style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">(Share Idea) <span class="p">prides itself as a company with the highest order of ethical conduct in its dealings with employees, customers, service provider, agents, governments or any other third party. It is important that you fully understand this philosophy and the relevant policies. If at any time during your employment with the Company, you are found to be in violation of such policy and/or generally accepted ethical/moral standards, the Company reserves the right to take disciplinary action against you, including right to terminate your employment without notice.</span></p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.5">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You declare that you are medically fit to carry out the duties expected of you by the Company. You represent that you have no communicable disease and you are not addicted to drugs or any other substance of abuse. During the term of your employment with the Company, you are required to be</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">medically fit to perform the duties assigned to you from time to time. As to whether you are medically fit, is an issue which will be professionally determined by the Company and you shall be bound by such determination. The Company may require you to undergo periodical medical examination as and when intimated to you by the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.6">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You represent that you are not in breach of any contract with any third party or restricted in any way in your ability to undertake or perform your duties towards the Company. You covenant that you will be fully responsible for any personal liabilities that may arise as the result of an agreement or arrangement between you and any third party and that the Company will in no way be concerned with such liabilities.</p>
                                        </li>
                                        <li data-list-text="5.7">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You will at all times maintain your ability to be employable and in the event of any change in your personal circumstances resulting in possible alteration to the employability status, you will keep the Company informed in writing about such change.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.8">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">During your employment with the Company, to meet the exigencies of business, the Company may require you to (i) work on any project that you are assigned to, on any technical platforms/skills and nature of the project or (ii) work night hours or (iii) work in shifts (including night shifts<i><b>).</b></i></p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.9">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Regardless of any secondment to any of the Company&#39;s affiliated entity/business associate/joint venture or where you may be required to work overseas for any such entity for an extensive period, you shall at all times remain an employee of the Company exclusively and shall not be entitled to any such foreign salary or benefits (including medical insurance, green card sponsorship, etc.) payable or applicable to employees of such other <i>(Share Idea) </i>entities other than the salary and benefits specified in the Employment Letter and/or the salary and benefits that may be determined by <i>(Share Idea) and </i>communicated to you in writing.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.10">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Unless specifically authorized by the Company in writing, you shall not sign any contract or agreement that binds the Company or creates any obligation (financial or otherwise) upon the Company. You shall also not enter into any commitments or dealings on behalf of the Company for which you have no express authority nor alter or be a party to any alteration of any principle or policy of the Company or exceed the authority or discretion vested in you without the previous sanction of the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.11">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">During the period of employment, you agree not to draw, accept or endorse any cheque or bill on behalf of the Company or, in any way, pledge the Company&#39;s credit except so far as you may have been authorized by the Company to do so, either generally or in any particular case.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.12">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">During the term of your employment, you shall not communicate with the media or with journalists in relation to the Company or its affairs, without obtaining a specific prior written permission from the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.13">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You acknowledge and provide your consent vide Consent Letter for use of personal information including Sensitive Personal Data or Information (&#39;&#39;SPDI&#39;&#39;) to the Company (a) to share your sensitive personal data or information about you and/or your dependents (wherever applicable) provided to the Company with third parties for purposes deemed appropriate by the Company from time to time; (b) to share information about you with affiliates of the Company for administrative purposes/audit and with clients/prospects in relation to any staff augmentation requirements; (c) to treat any personal data to which you have access in the course of your employment strictly in accordance with Company policies and not using any such data other than in connection with and except to the extent necessary for the</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">purposes for which it was disclosed to you. You further acknowledge and consent for use of your personal images and voices in marketing material, videos, etc; and confirm that you have read and understood the Company&#39;s Privacy Policy in relation to the collection, processing, use, storage and transfer of SPDI and you agree to the terms thereof.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.14">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You agree to comply with all laws, ordinances, regulations applicable in relation to your employment with the Company including but not limited to the anti-corruption laws, anti-bribery laws such as Prevention of Corruption Act, 1988 of India, or data privacy laws. Without limiting the generality of the foregoing, you represent and covenant that you have not, and shall not, at any time, during your employment with the Company, pay, give, or offer or promise to pay or give, any money</p>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">or any other thing of value, directly or indirectly, to, or for the benefit of: (i) any public servant, government official, political party or candidate for political office; or (ii) any other person, firm, corporation or other entity, with knowledge that some, or all of that money, or other thing of value will be paid, given, offered or promised to a public servant, government official, political party or candidate for political office, for the purpose of obtaining or retaining any business, or to obtain any other unfair advantage, in connection with the Company&#39;s business.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="5.15">
                                            <p style="padding-left: 63pt;text-indent: -20pt;text-align: justify;">You hereby represent to the Company that:</p>
                                            <ol id="l17">
                                                <li data-list-text="a.)">
                                                    <p style="padding-left: 91pt;text-indent: -12pt;text-align: left;">you are legally permitted to reside and be employed in India;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">you have reviewed these terms and conditions and that you understand the terms, purposes and effects of the same;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="c.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">you have accepted these terms and conditions only after having had the opportunity to seek clarifications;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="d.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">you have not been subjected to duress or undue influence of any kind to accept these terms and conditions and these terms and conditions will not impose an undue hardship upon you;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="e.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: justify;">you have accepted these terms and conditions of your own free will and without relying upon any statements made by the Company or any of its representatives, agents or employees; and</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="f.)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">you have all requisite power and authority, and do not require the consent of any third party to accept our offer.</p>
                                                </li>
                                            </ol>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="6.">
                                    <h1 style="padding-top: 8pt;padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark14">CONFIDENTIALITY:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l18">
                                        <li data-list-text="6.1">
                                            <p style="padding-top: 5pt;padding-left: 42pt;text-indent: 0pt;text-align: left;">This is a highly Confidential and Private document. You are required to maintain, at all times, confidentiality and ensure that the contents or details of this Letter are not shared with anyone.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You are aware that in the course of your employment with the Company, you shall have access to Confidential Information. &#39;&#39;Confidential Information&#39;&#39; shall mean and include, but not limited to, proprietary, confidential, sensitive, personal information about</p>
                                            <p style="padding-top: 1pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">inventions, products, designs, methods, know-how, techniques, trade secrets, systems, processes,</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">strategies, software programs, content, data, techniques, plans, designs, programs, customer information, works of authorship, intellectual property rights, customer lists, employee lists and any other personally identifiable information about any employee of the Company or its affiliate or personally identifiable information of its customers or clients of its customers, user lists, vendor lists, content provider lists, supplier lists, pricing information, projects, budgets, plans, projections, forecasts, financial information and proposals, intellectual property, terms of this Letter and any other information which due to the nature or character of such information, any prudent person might reasonably under similar circumstances treat such as confidential or would expect the Company to regard such information as Confidential, all regardless as to whether such information is in written form or electronic form or disclosed orally before or after the date hereof.</p>
                                        </li>
                                        <li data-list-text="6.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You agree that you may receive in strict confidence all Confidential Information of the Company, its affiliates or its clients or prospective clients of the Company or its affiliates. You further agree to maintain and to assist the Company in maintaining the confidentiality of all such Confidential Information, and to prevent it from any unauthorized use.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.4">
                                            <p style="padding-left: 57pt;text-indent: -15pt;text-align: justify;">You agree and confirm that, you will, at all times:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l19">
                                                <li data-list-text="a)">
                                                    <p style="padding-left: 78pt;text-indent: 9pt;text-align: left;">Maintain in confidence all such Confidential Information and will not use such Confidential Information other than as necessary to carry out the purpose for which it was shared with you;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b)">
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">Not disclose, divulge, display, publish, or disseminate any such Confidential Information to any person except with the Company&#39;s prior written consent;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                    <ol id="l20">
                                                        <li data-list-text="d)">
                                                            <p style="padding-left: 60pt;text-indent: -18pt;text-align: left;">Treat all such Confidential Information with the same degree of care that you accord to your own confidential information, but in no case less than reasonable care;</p>
                                                            <p style="text-indent: 0pt;text-align: left;">
                                                                <br/>
                                                            </p>
                                                        </li>
                                                        <li data-list-text="e)">
                                                            <p style="padding-left: 72pt;text-indent: -10pt;text-align: left;">Prevent the unauthorized use, dissemination or publication of such Confidential Information.</p>
                                                            <p style="text-indent: 0pt;text-align: left;">
                                                                <br/>
                                                            </p>
                                                        </li>
                                                        <li data-list-text="f)">
                                                            <p style="padding-left: 96pt;text-indent: -18pt;text-align: left;">Not copy or reproduce any such Confidential Information except as is reasonably necessary for the purpose for which it was shared with you;</p>
                                                        </li>
                                                    </ol>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                    <ol id="l21">
                                                        <li data-list-text="f)">
                                                            <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">Not share such Confidential Information with any third party (specifically those people who are in the same field of activities as that of the Company or are in direct or indirect competition to the Company);</p>
                                                            <p style="text-indent: 0pt;text-align: left;">
                                                                <br/>
                                                            </p>
                                                        </li>
                                                        <li data-list-text="g)">
                                                            <p style="padding-left: 60pt;text-indent: -18pt;text-align: left;">Not use such Confidential Information in any way so as to procure any commercial advantage for yourself or for any third party or in a manner that is directly or indirectly detrimental to the Company;</p>
                                                            <p style="text-indent: 0pt;text-align: left;">
                                                                <br/>
                                                            </p>
                                                        </li>
                                                        <li data-list-text="h)">
                                                            <p style="padding-left: 6pt;text-indent: 1pt;text-align: left;">Neither obtain nor claim any ownership interest in any knowledge or information obtained from such Confidential Information; and</p>
                                                            <p style="text-indent: 0pt;text-align: left;">
                                                                <br/>
                                                            </p>
                                                        </li>
                                                        <li data-list-text="i)">
                                                            <p style="padding-top: 5pt;padding-left: 114pt;text-indent: -35pt;text-align: left;">Not use or attempt to use any such Confidential Information in any manner that may harm or cause loss or may be reasonably expected to harm or cause loss, whether</p>
                                                        </li>
                                                    </ol>
                                                    <p style="padding-left: 121pt;text-indent: 0pt;text-align: left;">directly or indirectly, to the Company, its affiliates or its customers.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="6.5">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">All such Confidential Information shall remain the sole and exclusive property of the Company, and no license, interest or rights (including, without limitation, any intellectual property rights) to such Confidential Information, or any copy, portion or embodiment thereof, is granted or implied to be granted. Nothing in this Letter shall limit in any way the Company&#39;s right to develop, use, license, create derivative works of, or otherwise exploit its own Confidential Information.</p>
                                        </li>
                                        <li data-list-text="6.6">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">You shall be under no obligation of maintaining confidentiality of such Confidential Information as per provisions of this clause if the information:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l22">
                                                <li data-list-text="a)">
                                                    <p style="padding-left: 96pt;text-indent: -18pt;text-align: left;">was in your possession before receiving the same from the Company pursuant to this Letter;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b)">
                                                    <p style="padding-left: 97pt;text-indent: -11pt;text-align: left;">is or becomes a matter of public knowledge through no fault of yours; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="c)">
                                                    <p style="padding-left: 53pt;text-indent: -10pt;text-align: left;">is rightfully received by you from a third party without a duty of confidentiality.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="6.7">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">If you are served with a court or governmental order requiring disclosure of any part of such Confidential Information, you shall, unless prohibited by law, promptly notify the Company before any disclosure and cooperate fully (reasonable expense to be borne by the Company) with Company and its legal counsel in opposing, seeking a protective order or limit, or appealing any such <b>subpoena, legal </b>process, request or order to the extent deemed appropriate by the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.8">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Upon cessation of your employment with the Company or on a written request of the Company, whichever is earlier, you shall return or destroy (at the Company&#39;s option) any part of such Confidential Information that consists of original, and copies of, source material provided to you and still in your possession and, if requested by the Company, shall provide written confirmation to the Company to that effect.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.9">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You shall not, whether during your employment and/or after cessation of your employment, for whatever reason, use, disclose, divulge, publish or distribute to any person or entity, otherwise than as necessary for the proper performance of your duties and responsibilities under this Letter, or as required by law, any confidential information, messages, data or trade secrets acquired by you in the course of your employment with the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.10">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">If you are found to be in breach of this clause, the Company reserves the right to take disciplinary action against you, including right to terminate your employment without notice.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="6.11">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You shall maintain the confidentiality of all price sensitive information and shall handle all such information on a strict &#39;need to know&#39; basis i.e. disclose only to those within the Company who need the information to discharge their duty. You shall not pass on such Information to any person directly or</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">indirectly by way of making a recommendation for the purchase or sale of securities. Further, during your employment, you shall be subject to applicable trading restrictions e.g. when the trading window is closed, you shall not trade in the Company or any of its affiliates&#39; securities during such period.</p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="7.">
                                    <h1 style="padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark15">INTELLECTUAL PROPERTY</a><span class="p">:</span></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l23">
                                        <li data-list-text="7.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">&#39;&#39;Intellectual Property Rights&#39;&#39; shall mean all industrial and intellectual property rights (including both economic and moral rights), including, without limitation, patents, patent applications, patent rights, trademarks, trademark applications, trade names, service marks, service mark applications, copyrights, copyright applications, databases, algorithms, manuscripts, computer programs and other software, know-how, trade secrets, proprietary processes and formulae, inventions, trade dress, logos, design and all documentation and media constituting, describing or relating to the above.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You represent that all services performed by you for the Company shall be your original work and shall not incorporate any third-party materials or work in which you or any third party asserts an ownership interest or Intellectual Property Right. Provided that in the event the Company is held liable or is faced with a claim for your violation of any Intellectual Property Rights belonging to a third party, you undertake to indemnify the Company (and/or any of its affiliates, as the case may be) against any and all losses, liabilities, claims, actions, costs and expenses, including reasonable attorney&#39;s fees and court fees resulting there from.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">If at any time during your employment with the Company, you (either alone or with others) whether or not during normal business hours or arising in the scope of your duties of employment make, conceive, create, discover, invent or reduce to practice any invention, modification, discovery, design, development, improvement, process, software program, work of authorship, documentation, formula, data, technique, know-how, trade secret or any Intellectual Property Right whatsoever (including all work in progress) or any interest therein (whether or not patentable or registrable under copyright, trademark or similar statutes or subject to analogous protection) (collectively &#39;Developments&#39; ) that:</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l24">
                                                <li data-list-text="a)">
                                                    <p style="padding-left: 96pt;text-indent: -17pt;text-align: justify;">relates to the business of the Company (or its affiliate), or to its customers or suppliers, or to any of the products or services being developed, manufactured, sold or provided by the Company (or any of its affiliate) or which may be used in relation therewith;</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="b)">
                                                    <p style="padding-left: 89pt;text-indent: -11pt;text-align: left;">results from tasks assigned to you by the Company; or</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="c)">
                                                    <p style="padding-left: 96pt;text-indent: -17pt;text-align: justify;">results from the use of premises or personal property (whether tangible or intangible) loaned, eased or contracted for by the Company or its affiliate, such Developments (including all work in progress) and the benefits thereof shall become the sole and absolute property of the Company, as works made for hire or otherwise, and you shall immediately disclose to the Company, without cost or delay and without communicating to others the same, each such Development and all available information relating thereto (with all necessary plans and models).</p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="7.4">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You hereby irrevocably, absolutely and perpetually assign any and all rights (including any Intellectual Property Rights) you may have or acquire in the Developments and all benefits and/or rights resulting therefrom to the Company and its assigns without additional compensation on worldwide basis. You acknowledge that the salary and other payments receivable by you from the Company is</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">adequate compensation for such assignment. You hereby waive and quitclaim to the Company any and all claims of any nature whatsoever that you may now have or may hereafter have in and to the Developments (including all work in progress).</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.5">
                                            <h1 style="padding-left: 6pt;text-indent: 0pt;text-align: justify;"><span class="p">All such assignment of rights shall be perpetual irrevocable, universal and shall not lapse, even if the Company fails at any time to commercially exploit any such Developments. Notwithstanding the provisions </span>of<span class="s1"> </span>Section 19(4) of the Copyright Act, 1957, any assignment in so far as it relates to copyrightable material<span class="s1"> </span>shall<span class="s1"> </span><span class="p">not lapse nor the rights transferred therein revert to you, even if the Company does not exercise the rights under the</span></h1>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">assignment within a period of one year from the date of assignment. You hereby agree to waive any right to and refrain from raising any objection or claims to the Copyright Board with respect to any assignment, pursuant to Section 19A of the Copyright Act, 1957. You further agree to assist and cooperate with the Company in perfecting the Company&#39;s rights in any of the Developments.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.6">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Any assignment of copyright hereunder (and any ownership of a copyright as a work made for hire) includes all rights of paternity, integrity, disclosure and withdrawal and any other rights that may be known as or referred to as &#39;moral rights&#39; (collectively &#39;Moral Rights&#39;). If, you are deemed under applicable law to retain any rights in any Developments, including without limitation any Moral Rights, you hereby waive, and agree to waive, all such rights. To the extent that such waivers are deemed unenforceable under applicable law, you grant, and agree to grant, to the Company or its assigns the exclusive, perpetual, irrevocable, universal and royalty-free license to use, modify and market the Development, without identifying you or seeking your consent.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.7">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">If you are not employed with the Company at the time when the Company requests your assistance in connection with the foregoing, the Company will pay you for your reasonable time expended in complying with the above terms at an hourly rate equal to the effective hourly rate at which you were paid the Company immediately prior to your termination as an employee.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.8">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Should the Company be unable to secure the signature on any document necessary to apply for, prosecute, obtain, protect or enforce any Intellectual Property Rights, due to any cause, you hereby irrevocably designate and appoint the Company and each of its duly authorized officers and agents as your agent and attorneys to do all lawfully permitted acts to further the prosecution, issuance, and enforcement of the Intellectual Property Rights or protection in respect of the Developments, with the same force and effect as if executed and delivered by you.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="7.9">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: left;">Notwithstanding the foregoing, you will also be bound by (<u><b>Share Idea)</b></u><b> </b>policy with respect to Intellectual Property.</p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="8.">
                                    <h1 style="padding-left: 17pt;text-indent: -10pt;text-align: justify;"><a name="bookmark16">CONFLICT OF INTEREST:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l25">
                                        <li data-list-text="8.1">
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">During your employment, you will not, directly or indirectly, whether alone or as a partner joint venture, officer, director, employee, consultant, agent, independent contractor or stockholder of any company, business or other commercial enterprise: (i) engage in any</p>
                                            <p style="padding-top: 1pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">business activity similar in nature to any business conducted or planned by the Company, or (ii) compete in any way with products or services being developed, marketed, distributed or otherwise</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <p style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: left;">provided by the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="8.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">You shall not undertake, whether directly or indirectly any full time or part time employment or operate or manage business of any kind whatsoever, so long as you are in employment with the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="8.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">During your employment if you become aware of any potential or actual conflict between your interests and those of the Company, then you shall immediately inform the Company about such conflict. Where the Company is of the opinion that such a conflict does or could exist, it may direct you to take appropriate action(s) to resolve such a conflict, and you shall comply with such instructions.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="8.4">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">During the course of your employment, you shall not, either directly or indirectly, receive or accept for your own benefit or the benefit of any person or entity other than the Company any gratuity, emolument, or payment of any kind from any person having or intending to have any business with the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="8.5">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">To perform your duties towards the Company, you will have access to email, internet, Company assets (desktop, laptop, mobile phones etc.) and other Company infrastructure. You shall ensure that at all times your use of such facilities meets the ethical and social standards of the workplace. Further, your use of such facilities must not interfere with your duties and must not be illegal or contrary to the interests of the Company.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="9.">
                                    <h1 style="padding-left: 17pt;text-indent: -10pt;text-align: left;"><a name="bookmark17">RETIREMENT/TERMINATION:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l26">
                                        <li data-list-text="a.)">
                                            <h1 style="padding-top: 4pt;padding-left: 19pt;text-indent: -13pt;text-align: left;"><a name="bookmark18">Retirement</a></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l27">
                                                <li data-list-text="(i)">
                                                    <p style="padding-top: 4pt;padding-left: 83pt;text-indent: -36pt;text-align: justify;">You will automatically retire from employment with the Company on the last day of the month in which you complete sixty (60) years of age. It is hereby clarified that the Company reserves it right to change the retirement age.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="b.)">
                                            <h1 style="padding-left: 19pt;text-indent: -13pt;text-align: left;"><a name="bookmark19">Notice Period/Termination</a></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l28">
                                                <li data-list-text="(i)">
                                                    <p style="padding-top: 4pt;padding-left: 78pt;text-indent: -35pt;text-align: justify;">During the probation period, your employment with the Company may be terminated (i) by you, upon giving the Company 1 months&#39; written notice or at the Company&#39;s discretion, payment of gross salary in lieu of notice or (ii) by the Company, upon</p>
                                                    <p style="padding-left: 78pt;text-indent: 0pt;text-align: left;">giving you 1 months&#39; written notice or payment of gross salary in lieu thereof. Upon confirmation, your employment with the Company may be terminated (i) by you, upon giving the Company 2 months&#39; written notice or at the Company&#39;s discretion, payment of gross salary in lieu of notice or (ii) by the Company, upon giving you 1 months&#39; written notice or payment of gross salary in lieu thereof.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(ii)">
                                                    <p style="padding-left: 83pt;text-indent: -36pt;text-align: justify;">Notwithstanding anything to the contrary, the Company reserves the right to relieve you from services of the Company only upon your satisfactory handover of all the duties and responsibilities assigned to you (including but not limited to any knowledge transfer and serving the notice period conditions).</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(iii)">
                                                    <p style="padding-top: 5pt;padding-left: 82pt;text-indent: -35pt;text-align: justify;">Notwithstanding the aforesaid or anything else to the contrary, the Company may suspend, dismiss, discharge or terminate your employment with immediate effect by a notice in writing (without salary in lieu of notice), in the event of (i) fraudulent, dishonest or undisciplined conduct by you, (ii) you committing a breach of integrity, or embezzlement, or misappropriation or misuse or causing damage to the Company&#39;s asset/property, (iii) your insubordination or failure to comply with the directions given to you by persons so authorized, (iv) your insolvency or conviction for any offence involving moral turpitude, (v) your breach of any terms or conditions of this Letter or the Company&#39;s policies or other documents or directions of the Company, (vi) you going on or abetting a strike in contravention of any law for the time being in force, (vii) you conducting yourself in a manner which is regarded by the Company as prejudicial to its own interests or to the interests of its clients or (viii)misconduct by you as provided under the labour laws and/or in the Company policies.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(iv)">
                                                    <p style="padding-left: 82pt;text-indent: -35pt;text-align: justify;">In the event of willful neglect or breach of any of the terms hereof or refusal on your part to carry out the lawful instructions of any authorized officer of the Company or being guilty of misconduct, the Company may terminate your employment forthwith without notice and with no obligation to pay you any compensation.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                                <li data-list-text="(v)">
                                                    <p style="padding-left: 82pt;text-indent: -35pt;text-align: justify;">In case you absent yourself from duty continuously, without prior authorization, for ten (10) consecutive calendar days or more you shall be deemed to have left and relinquished the service on your own accord and such relinquishment of service shall be deemed as a repudiation of your employment. In such circumstances, the Company will have the discretion of (a) adjusting salary against the notice period of such abandonment and recover any outstanding dues towards payable to the Company; and (b) presume that you have voluntarily abandoned the services of the Company and strike off your name from the Company&#39;s payroll.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                </li>
                                            </ol>
                                        </li>
                                        <li data-list-text="c.)">
                                            <h1 style="padding-left: 19pt;text-indent: -12pt;text-align: left;"><a name="bookmark20">Effects of Cessation of Employment</a></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                            <ol id="l29">
                                                <li data-list-text="(i)">
                                                    <p style="padding-top: 4pt;padding-left: 81pt;text-indent: -38pt;text-align: justify;">Upon cessation of your employment with the Company (whether by virtue of termination/resignation/retirement), you will immediately return to the Company all of the Company&#39;s Confidential Information, tools, assets, accessories, formulae, documents, specifications, books etc. in your custody, care of charge and obtain clearance certificate from the relevant person/office/department, on production of which alone your dues, if any, will be settled by the Company, failing which the Company reserves the right to adjust the dues against any amounts payable to you or separately claim the same from you or use available legal remedies to recover the assets or any other amount due to the Company.</p>
                                                    <p style="text-indent: 0pt;text-align: left;">
                                                        <br/>
                                                    </p>
                                                    <ol id="l30">
                                                        <li data-list-text="(vi)">
                                                            <p style="padding-left: 97pt;text-indent: -45pt;text-align: left;">If any Letter of Authority or Power of Attorney is issued to you, you will undertake to return it on demand or immediately upon cessation of your employment with the Company.</p>
                                                        </li>
                                                        <li data-list-text="(vii)">
                                                            <p style="padding-left: 83pt;text-indent: -36pt;text-align: left;">Upon cessation of your employment with the Company, the Company may require you to sign appropriate release terms without any additional compensation.</p>
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="10.">
                                    <h1 style="padding-top: 4pt;padding-left: 23pt;text-indent: -16pt;text-align: left;"><a name="bookmark21">LIMITATION OF LIABILITY AND INDEMNITY:</a></h1>
                                    <ol id="l31">
                                        <li data-list-text="10.1">
                                            <p style="padding-top: 5pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">Neither party shall be liable to the other party for any indirect, incidental, contingent, consequential, punitive, exemplary, special or similar damages, including but not limited to, loss of profits or loss of data, whether incurred as a result of negligence or otherwise, irrespective of whether either party has been advised of the possibility of the incurrence by the other Party of any such damages.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="10.2">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">The Company&#39;s liability arising out of or in connection with this Letter, whether based in contract, tort (including negligence and strict liability) or otherwise, shall not exceed the amount paid by the Company to you for a period of three (3) months preceding the cause of action.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="10.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Notwithstanding anything to the contrary contained herein, you shall indemnify and keep indemnified the Company, its directors, officers and employees from and against all claims, demands, actions, suits and proceedings (including any losses, damages, costs, charges and expenses), whatsoever that may be brought or made against the Company by any third party as a result of any act or omission, non-performance or non-observance by you of any of the terms and conditions of this Letter and/or arising from your failure to comply to any statute or enactment/s (including but not limited anti-bribery laws and data protection laws).</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                    </ol>
                                </li>
                                <li data-list-text="11.">
                                    <h1 style="padding-left: 23pt;text-indent: -16pt;text-align: left;"><a name="bookmark22">MISCELLANEOUS:</a></h1>
                                    <p style="text-indent: 0pt;text-align: left;">
                                        <br/>
                                    </p>
                                    <ol id="l32">
                                        <li data-list-text="11.1">
                                            <h1 style="padding-top: 4pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">Notice:<span class="s1"> </span><span class="p">All notices to you in relation to your employment shall be in writing and in English language and shall be served either by hand delivery or by sending the same by registered post or by email (as per Company records) or by courier or by speed post addressed to the address mentioned hereinabove. It will be your responsibility to inform the Company of any change in your address and contact details including telephone numbers, personal email addresses etc. All notices to the Company in relation to your employment shall be in writing and in English language and shall be served either by hand delivery or by sending the same by registered post or by courier or by speed post addressed to the Company&#39;s office address referred in the Employment Letter or by email with a physical copy by any of the abovementioned ways.</span></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.2">
                                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Severability: <span class="p">The parties acknowledge and agree that if any of the provision of this Letter is deemed invalid, void, illegal, and unenforceable that provision stands severed from this Letter and the remaining provisions of this Letter shall remain valid and enforceable.</span></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.3">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;"><u><b>Publicity: </b></u>You shall not use the name and/or trademark/logo of <i>(Share Idea)</i>, its group companies, subsidiaries or associates before media (irrespective of the form whether print, audio visual, electronic etc.) in any other manner which is detrimental to the interest, image and goodwill of the Company and its affiliates without prior written consent of the Company. In the event you intend to share/disclose article which includes any information about the Company or its affiliates/customers</p>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">for possible publication or dissemination outside the <i>(Share Idea)</i>, you agree to inform the Company and obtain its prior written consent on the article you wish to disclose. Further, you agree to make such modifications/deletions/revisions to the article as are requested by the Company to protect its property/interest/reputation.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.4">
                                            <h1 style="padding-top: 5pt;padding-left: 42pt;text-indent: 0pt;text-align: justify;">Non-Disparagement: <span class="p">During the term of your employment with the Company and at all times thereafter, you will not make any false, defamatory or disparaging statements about the Company, or the employees, officers or directors of the Company that are reasonably likely to cause damage to any such entity or person.</span></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.5">
                                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Waiver:<span class="s1"> </span><span class="p">No delay or failure of any party in exercising or enforcing any of its rights or remedies whatsoever shall operate as a waiver of those rights or remedies or so as to preclude or impair the exercise or enforcement of those rights or remedies. No single or partial exercise or enforcement of any right or remedy by any party shall preclude or impair any other or further exercise or enforcement of that right or remedy by that Party. Save as expressly provided in this Letter neither party shall be deemed to have waived any of its rights or remedies whatsoever unless the waiver is made in writing, signed by a duly authorized representative of that party and may be given subject to any conditions thought fit by the grantor. Unless otherwise expressly stated any waiver shall be effective only in the instance and for the purpose for which it is given.</span></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.6">
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;"><u><b>Integration: </b></u>This Letter along with its <b>Exhibit </b>constitutes the entire understanding between the parties and supersedes all previous agreements (written or oral) between the Parties in relation to its subject-matter.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.7">
                                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Survival: Clauses <span class="p">5.1, 5.13, 6, 7, 9(c), 10, 11.1, 11.7, 11.8 and 11.9 and any other clause which by its nature is expected to survive shall all survive the expiry/termination (for whatever reason) of the Letter and shall continue to apply.</span></h1>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.8">
                                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">Dispute Resolution/Governing Law: <span class="p">The Parties to this Agreement shall make best efforts to settle by mutual conciliation any claim, dispute or controversy (&#39;&#39;Dispute&#39;&#39;) arising out of, or in relation to, this Agreement, including any Dispute with respect to the existence or validity hereof, the interpretation hereof, or the breach hereof. All disputes, differences and/or claims arising out of these presents or as to the construction, meaning or effect hereof or as to the rights and liabilities of the Parties hereunder and which cannot be settled by mutual conciliation shall be referred to Arbitration to be held in Mumbai in English Language in accordance with the Arbitration and Conciliation Act</span></h1>
                                            <p style="padding-left: 42pt;text-indent: 0pt;text-align: justify;">1996, or any statutory amendments thereof and shall be referred to a sole Arbitrator to be appointed by <i>(Share Idea)</i>. The award of the Arbitrator shall be final and binding on Parties. This Letter shall be governed and interpreted in accordance to the laws of India and the courts at Mumbai only shall have exclusive jurisdiction.</p>
                                            <p style="text-indent: 0pt;text-align: left;">
                                                <br/>
                                            </p>
                                        </li>
                                        <li data-list-text="11.9">
                                            <h1 style="padding-left: 42pt;text-indent: 0pt;text-align: left;">Rights to Injunctive Relief: <span class="p">You hereby expressly acknowledges that any breach or threatened breach by you of any of your obligations set forth in this Letter and/or any of the Company policies may result in significant and continuing injury and irreparable harm to Company, the monetary value of which would be impossible to establish. Therefore, you agree that the Company shall be entitled to injunctive relief in a court of appropriate jurisdiction with respect to such provisions.</span></h1></li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                    </ol>
               </div>




            </div>
        </div>
        </div>
    <br>
    <!--  <button class="print-link no-print btn btn-success"  onclick="jQuery('#ele1').print()">
    Print
    </button> -->
    </div>
</body>
</html>