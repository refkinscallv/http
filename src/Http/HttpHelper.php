<?php

    namespace RF\Http;

    class HttpHelper {

        public static function sanitize(string $input) {
            if (is_array($input)) {
                $sanitized_array = [];

                foreach ($input as $key => $value) {
                    $sanitized_key = htmlspecialchars(trim($key), ENT_QUOTES, 'UTF-8');
                    $sanitized_value = self::sanitize($value);
                    $sanitized_array[$sanitized_key] = $sanitized_value;
                }
                
                return $sanitized_array;
            } else {
                return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
            }
        }

        public static function filterArrayKeys(array $array, array $keysToKeep): array {
            return array_filter(
                $array,
                function ($key) use ($keysToKeep) {
                    return in_array($key, $keysToKeep);
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        public static function filterArrayKeysRecursive(array $array, array $keysToKeep): array {
            $filteredArray = array_filter(
                $array,
                function ($key) use ($keysToKeep) {
                    return in_array($key, $keysToKeep);
                },
                ARRAY_FILTER_USE_KEY
            );
        
            foreach ($filteredArray as &$value) {
                if (is_array($value)) {
                    $value = filter_array_keys_recursive($value, $keysToKeep);
                }
            }
        
            return $filteredArray;
        }

        public static function countArrayKeys(array $array, bool $recursive = false): int {
            $totalCount = 0;
        
            $countFunction = function(array $array, &$totalCount) use (&$countFunction, $recursive) {
                foreach ($array as $key => $value) {
                    $totalCount++;
                    if ($recursive && is_array($value)) {
                        $countFunction($value, $totalCount);
                    }
                }
            };
        
            $countFunction($array, $totalCount);
            return $totalCount;
        }        

    }