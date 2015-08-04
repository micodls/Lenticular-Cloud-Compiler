#!/bin/bash
#exec script: from compMgrVM to compVM
compileThis = codeToCompile.cpp
outputFile = output.txt

touch $compileThis
touch $outputFile

# get string from editor and save to file
read codeText
echo $codeText >  $compileThis

# compile file > compile output to text file
gcc $compileThis && ./a.out
make &> $outputFile

# run > output to text file
# if compile error send compile.txt to editor as string
# else send output.txt to editor as string

echo -e '\n' > $outputFile

# remove files

rm -rf $compileThis
rm -rf $output
