<?php

/**
 * Function to translate months.
 */
function translateMonth($date) {
  switch ($date) {
    case 1:
      $month = 'Janeiro';
      break;
    case 2:
      $month = 'Fevereiro';
      break;
    case 3:
      $month = 'Março';
      break;
    case 4:
      $month = 'Abril';
      break;
    case 5:
      $month = 'Maio';
      break;
    case 6:
      $month = 'Junho';
      break;
    case 7:
      $month = 'Julho';
      break;
    case 8:
      $month = 'Agosto';
      break;
    case 9:
      $month = 'Setembro';
      break;
    case 10:
      $month = 'Outubro';
      break;
    case 11:
      $month = 'Novembro';
      break;
    case 12:
      $month = 'Dezembro';
      break;

    default:
      break;
  }

  return $month;
}
