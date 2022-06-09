#!/bin/bash

broker="localhost"
#user="student"
#pass="student"
declare -a salles=("E201" "E202" "E101" "E102")
tailleSalles=$(echo ${#salles[@]})
declare -a topics=(
"sae/bate2/E202/temperature" 
"sae/bate2/E202/luminosite" 
"sae/bate2/E201/temperature"  
"sae/bate2/E201/luminosite" 
"sae/bate1/E101/temperature"  
"sae/bate2/E101/luminosite"
"sae/bate1/E102/temperature"  
"sae/bate1/E102/luminosite")
tailleTopics=$(echo ${#topics[@]})
declare -A valTemp
declare -A valLum
maxTemp=25
minTemp=18
maxLum=80
minLum=40

for ((n=0;n<$tailleSalles;n++))
do
    valTemp[${salles[$n]}]=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
    valLum[${salles[$n]}]=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))
done

while true
do
    for ((n=0;n<$tailleSalles;n++))
    do
        newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
        newLum=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))

        diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
        diffTemp2=$(echo $diffTemp | tr -d -)
        diffLum=$(($newLum - valLum[${salles[$n]}]))
        diffLum2=$(echo $diffLum | tr -d -)

        while [ $diffTemp2 -ge 2 ]
        do
            newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))      
            diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
            diffTemp2=$(echo $diffTemp | tr -d -)       
        done
        while [ $diffLum2 -ge 20 ]
        do
            newLum=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))   
            diffLum=$(($newLum - valLum[${salles[$n]}]))
            diffLum2=$(echo $diffLum | tr -d -)  
        done
        
        valTemp[${salles[$n]}]=$newTemp
        valLum[${salles[$n]}]=$newLum

    done

    for ((n=0;n<$tailleTopics;n++))
    do
        topic=$(echo ${topics[$n]})
        room=$(echo $topic | cut -d "/" -f 3)
        sensor=$(echo $topic | cut -d "/" -f 4) 
        if [ "$sensor" == "temperature" ]
        then
            val=$(echo ${valTemp[$room]})
        else
            val=$(echo ${valLum[$room]})
        fi   
        mosquitto_pub -h $broker -t $topic -m "$val"
        echo $val
        sleep 5
    done
    sleep 10
done
