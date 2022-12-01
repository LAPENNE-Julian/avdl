<?php 

namespace App\Utils;

use App\Models\Anecdote;

/**
 * Navigation to previous and next anecdote.
 */
class ApiNavigationAnecdote {

    /**
     * Navigation to next of anecdote array. 
     *
     * @param array $array
     * @return Anecdote|false $nextAnecdote
     */
    public function next($array, int $id)
    {
        //get key and informations foreach anecdotes
        foreach ($array as $key => $anecdote){
            //count key in array
            $indexMax = count($array) - 1;
            //get anecdote id
            $anecdoteId = $anecdote['id'];
            
            //if the request id is egal to one of the anecdote id in the loop
            if($id == $anecdoteId){
                //the current anecdote is set to the current key
                $currentAnecdote = $array[$key];

                //if the current anecdote key is up to the count array
                if($currentAnecdote == $array[$indexMax]){
                    //return at the beginning of the array
                    $nextAnecdote = $array[0]; 

                }else{
                    //pass to the next ocurence array
                    $nextAnecdote = $array[$key + 1];
                }      
            }    
        }

        //if the id request isn't exist in the $array
        if (isset($nextAnecdote) == false) {
            return false;
        }

        return $nextAnecdote['id'];
    
    }

    /**
     * Navigation to previous of anecdote array. 
     *
     * @param array|collection $array
     * @return Anecdote|false $previousAnecdote
     */
    public function previous($array, int $id)
    {
        //get key and informations foreach anecdotes
        foreach ($array as $key => $anecdote){
            //count key in array
            $indexMax = count($array) - 1;
            //get anecdote id
            $anecdoteId = $anecdote['id'];
            
            //if the request id is egal to one of the anecdote id in the loop
            if($id == $anecdoteId){
                //the current anecdote is set to the current key
                $currentanecdote = $array[$key];

                //if the current anecdote key is at the beginning array
                if ($currentanecdote == $array[0]){
                    //return at the end of the array
                    $previousAnecdote = $array[$indexMax]; 

                }else{
                    //pass to the previous ocurence array
                    $previousAnecdote = $array[$key - 1];
                }      
            }    
        }

        //if the id request isn't exist in the $array
        if (isset($previousAnecdote) == false) {
            return false;
        }

        return $previousAnecdote['id'];
    }

}