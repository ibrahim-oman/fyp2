#include <stdio.h>
void main (void)
{
    char word[20];
	int i;
	int vowel_count=O;
    int non_vowel_count=O;

	printf("enter a sentance\n");
	scanf("%s",&word);


	for ( i = 0; i < 20; ++i)
	{
		switch(word[i])
  {
    case 'a':
    case 'A':
    case 'e':
    case 'E':
    case 'i':
    case 'I':
    case 'o':
    case 'O':
    case 'u':
    case 'U':
     vowel_count++;
      break;
    default:
     non_vowel_count++;
  }              
	}

printf("number of vowels is %d\n and non vowel is %d\n", vowel_count,non_vowel_count);


}