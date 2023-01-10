<?php
function convertNumber($num = false)
{
    $num = str_replace(array(',', ''), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = ' and ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    $words = $words . ".";
    return $words;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style>
    #tbl_border{
      border: 0.5px solid black;
      padding: 5px;
      font-size: 13px;
    }
    span{
      border-bottom: 0.5px solid black;
    }
    </style>
    <title>Order Payment</title>
  </head>
  <body>

  <table cellspacing="0" id="table_top" width="100%">
  	<tbody>
  		<tr>
  			<td style="width:550px;padding:0">
          COA FORM
  			</td>
        <td style="text-align:right; font-style:italic;">
          Appendix 28
        </td>
  		</tr>
  	</tbody>
  </table>

<table cellspacing="0" id="tbl_border" width="100%">
  <tbody>
    <tr>
      <td>
        <b>Entity Name :</b> <span>Research Institute for Tropical Medicine</span>
      </td>
      <td style="text-align:right;">
        <b>Serial No. :</b> <span style="text-align:center">NPR05-2022-01-0050</span>
      </td>
    </tr>
    <tr>
      <td>
        <b>Fund Cluster :</b> <span>05-Internally Generated Funds</span>
      </td>
      <td style="text-align:right;">
        <b>Date :</b> <span style="text-align:center">January 3, 2022</span>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center; padding:10px; font-size:18px; font-weight:bold;">ORDER OF PAYMENT</td>
    </tr>
    <tr>
      <td style="font-weight:bold;">The Collecting Officer</td>
    </tr>
    <tr>
      <td>Cash/Treasury Unit</td>
    </tr>
    <tr>
      <td colspan="2" style="padding:10px;"></td>
    </tr>
    <tr>
      <td style="text-align:center;">
        Please issue Official Receipt in favor of
      </td>
      <td style="text-align:left;">
        <span style="font-weight:bold;">Research Institute for Tropical Medicine</span>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;">
      </td>
      <td style="text-align:left;">
        <center><small>(Name of Payor)</small></center>
      </td>
    </tr>

    <tr>
      <td colspan="2" style="text-align:center; font-weight:bold; border-bottom: 0.5px solid black;">
        c/o Microbiology Department - NEQAS
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;">
        <small>(Address/Office of Payor)</small>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        in the amount of <span><b>&#8369; <?= convertNumber(4445);?></b></span>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        for payment of <span><b>Registration fee for NEQAS-22-1649387763</b></span>
      </td>
    </tr>

    <tr>
      <td colspan="2" style="text-align:center; font-weight:bold; border-bottom: 0.5px solid black;">
        Program Enrolled:
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;">
        <small>(Purpose)</small>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        per Bill No. _____________________________ dated ___________________________.
      </td>
    </tr>
    <tr>
      <td colspan="2" style="padding:10px;"></td>
    </tr>
    <tr>
      <td colspan="2">
        Please deposit the collections under Bank Account/s:
      </td>
    </tr>
    <tr>
      <td colspan="2" style="padding:10px;"></td>
    </tr>
  </tbody>

  <table cellspacing="0" width="100%">
    <tbody>
      <tr>
        <td style="text-align:center; text-decoration:underline;">No.</td>
        <td style="text-align:center; text-decoration:underline;">Name of Bank</td>
        <td style="text-align:center; text-decoration:underline;">Amount</td>
      </tr>
      <tr>
        <td style="text-align:center; border-bottom:0.5px solid black; font-weight:bold;">3832-1001-36</td>
        <td style="text-align:center; border-bottom:0.5px solid black; font-weight:bold;">RITM-INCOME (LBP)</td>
        <td style="text-align:center; border-bottom:0.5px solid black; font-weight:bold;"></td>
      </tr>
      <tr>
        <td><b>Total</b></td>
        <td></td>
        <td style="border-bottom:0.5px solid black; font-weight:bold;">PHP</td>
      </tr>
      <tr>
        <td colspan="3" style="padding:15px;"></td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:center; border-bottom: 0.5px solid black;">
          <b>LOURDES D. PALMA GIL, CPA</b>
        </td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:center;">
          Signature over Printed Name<br>
          Head of Accounting Division/Unit/Authorized Official
        </td>
      </tr>
    </tbody>
  </table>
</table>
<br>
<div style="text-align:center; color:grey; font-size:13px;">
  "This form is system generated."
</div>

</body>
</html>
