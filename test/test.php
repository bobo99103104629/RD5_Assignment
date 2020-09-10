<input class="txt" type="num"  placeholder="确认卡号" 
onkeyup="this.value=this.value.replace(/\D/g,'').replace(/....(?!$)/g,'$& ')"
>

<script>
//第一步：$no----->$str  把分隔开的字符串连在一起
$no = '6221 8816 0000 3658 686';
$str =implode(explode(' ',$no));
//第二步：$str----$no   把连在一起的字符串分割成隔开的数组
$str = '6221881600003658686';
$no =implode(' ',str_split($str,4));

function test_bankcode($code)
{
    $arr_no = str_split($code);
    $last_n = $arr_no[count($arr_no) - 1];
    krsort($arr_no);
    $i = 1;
    $total = 0;
    foreach ($arr_no as $n) {
        if ($i % 2 == 0) {
            $ix = $n * 2;
            if ($ix >= 10) {
                $nx = 1 + ($ix % 10);
                $total += $nx;
            } else {
                $total += $ix;
            }
        } else {
            $total += $n;
        }
        $i++;
    }
    $total -= $last_n;
    $x = 10 - ($total % 10);
    if ($x == $last_n) {
        return true;
    } else {
        return false;
    }

}
</script>