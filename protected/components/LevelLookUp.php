<?php

class LevelLookUp{
      const MEMBER = 0;
      const ADMIN  = 1 ;
      const SUPERADMIN  = 2;
      // For CGridView, CListView Purposes
      public static function getLabel( $level ){
          if($level == self::MEMBER)
             return 'Member';
          if($level == self::ADMIN)
             return 'Administrator';
            if($level == self::SUPERADMIN)
             return 'Super Administrator';
          return false;
      }
      // for dropdown lists purposes
      public static function getLevelList(){
          return array(
                 self::MEMBER=>'Member',
                 self::ADMIN=>'Administrator',
                 self::SUPERADMIN=>'Super Administrator',
                 );
    }
}