#!/bin/bash

# WARNING: Always run this in a copy of your photos, it will compress (and ruin if they are the originals) them, no questions asked.
# run like this to compress all jpg files in all subdirectories:
# find . -type d -exec bash -c "cd '{}' && pwd && bash /path/to/jpg-quality-reducer-standalone-strip-web-2048-85.sh" \;

resolution="2048x2048"
quality="85%"

quantization_table="/tmp/jpg-quality-reducer-quantization-table.xml"


cat > "$quantization_table" << EOF

<?xml version="1.0" encoding="windows-1252"?>
<!DOCTYPE quantization-tables [
<!ELEMENT quantization-tables (table)+>
<!ELEMENT table (description , levels)>
<!ELEMENT description (CDATA)>
<!ELEMENT levels (CDATA)>
<!ATTLIST table slot ID #REQUIRED>
<!ATTLIST levels width CDATA #REQUIRED>
<!ATTLIST levels height CDATA #REQUIRED>
<!ATTLIST levels divisor CDATA #REQUIRED>
]>
<!--
  JPEG quantization table created by Dr. Nicolas Robidoux, Senior Research
  Scientist at Phase One (www.phaseone.com) for use with 2x2 Chroma
  subsampling and (IJG-style, hence ImageMagick-style) quality level
  around 75.

  It is based on the one recommended in

    Relevance of human vision to JPEG-DCT compression by Stanley A. Klein,
    Amnon D. Silverstein and Thom Carney. In Human Vision, Visual
    Processing and Digital Display III, 1992.

  for 1 minute per pixel viewing.

  Specifying only one table in this xml file has two effects when used with
  the ImageMagick option
  
    -define jpeg:q-table=PATH/TO/THIS/FILE
  
  1) This quantization table is automatically used for all three channels;

  2) Only one copy is embedded in the JPG file, which saves a few bits
     (only worthwhile for very small thumbnails).
-->
<quantization-tables>
  <table slot="0" alias="luma">
    <description>Luma Quantization Table</description>
    <levels width="8" height="8" divisor="1">
      16,  16,  16,  18,  25,  37,  56,  85,
      16,  17,  20,  27,  34,  40,  53,  75,
      16,  20,  24,  31,  43,  62,  91,  135,
      18,  27,  31,  40,  53,  74,  106, 156,
      25,  34,  43,  53,  69,  94,  131, 189,
      37,  40,  62,  74,  94,  124, 169, 238,
      56,  53,  91,  106, 131, 169, 226, 311,
      85,  75,  135, 156, 189, 238, 311, 418
    </levels>
  </table>
<!--
  If you want to use a different quantization table for Chroma (say), just add 

  <table slot="1" alias="chroma">
    <description>Chroma Quantization Table</description>
    INSERT 64 POSITIVE INTEGERS HERE, COMMA-SEPARATED
    </levels>
  </table>

  here (but outside of these comments).
-->
</quantization-tables>

EOF


if [ ! -f reduced_quality.txt ]; then
    mkdir backup_before_reducing_quality;
    cp -lR *.[Jj][Pp]*[Gg] backup_before_reducing_quality/
    echo "Resized (if larger than $resolution) and quality reduced using the following command and the following quantization table, using "$(convert --version | head -n 1 | sed 's/http.*//g')"." > reduced_quality.txt; 
    cat "$0" >> reduced_quality.txt
    nice -n 16 mogrify -define jpeg:q-table=${quantization_table} -define jpeg:dct-method=float -quality "$quality" -auto-orient -resize "${resolution}"\> -strip -filter Lanczos -interlace Plane *.[Jj][Pp]*[Gg] ;
    rm -f *.[Jj][Pp]*[Gg]~* ;
    rm -rf backup_before_reducing_quality;
else
    echo "No action, quality already reduced."
fi
