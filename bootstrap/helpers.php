<?php

 function getMonths($index, $cut = false)
 {
     $full_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม",
     );
     $cut_month = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
     if ($cut) {
         return $cut_month[$index];
     }
     return $full_month[$index];
 }

 function dateThTimes($strDate)
 {
     $strYear = date("Y", strtotime($strDate)) + 543;
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strHour = date("H", strtotime($strDate));
     $strMinute = date("i", strtotime($strDate));
     $strSeconds = date("s", strtotime($strDate));
     $strMonthThai = getMonth($strMonth, true);
     return "$strDay $strMonthThai $strYear $strHour:$strMinute";
 }

 function dateThs($strDate)
 {
     $strYear = date("Y", strtotime($strDate)) + 543;
     $strMonth = date("n", strtotime($strDate));
     $strDay = date("j", strtotime($strDate));
     $strMonthThai = getMonth($strMonth);
     return "$strDay $strMonthThai พ.ศ. $strYear";
 }

 function timeFromDates($strDate)
 {
     $strHour = date("H", strtotime($strDate));
     $strMinute = date("i", strtotime($strDate));
     $strSeconds = date("s", strtotime($strDate));

     return "$strHour:$strMinute:$strSeconds";
 }
