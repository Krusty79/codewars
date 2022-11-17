from gtts import gTTS
from io import BytesIO
from playsound import playsound as play
import PyPDF2,os,sys

path_pdf = input("PDF:")
path_mp3 = path_pdf.replace(".pdf",".mp3")
path_txt = path_pdf.replace(".pdf",".txt")

#/home/krusty/Desktop/ProImage.pdf
if not os.path.isfile(path_pdf):
    sys.exit('PDF not exists '+path_pdf)

pdffileobj=open(path_pdf,'rb')
pdfreader=PyPDF2.PdfFileReader(pdffileobj)
x=pdfreader.numPages
pageobj=pdfreader.getPage(x-1)
text=pageobj.extractText().replace("\n", " ")

file1=open(path_txt,"w")
file1.writelines(text)

tts = gTTS(text=text, lang='en')
tts.save(path_mp3)

if not os.path.isfile(path_mp3):
    sys.exit('MP3 not exists '+path_mp3)

#play(path_mp3)

sys.exit("TXT:"+path_txt+"\nMP3:"+path_mp3)

file1=open(r"test.txt","w")
file1.writelines(text.replace("\n", " "))

# Language in which you want to convert
file1=open(r"test.txt","r")
tts = gTTS(text=file1.read(), lang='en')
tts.save('test.mp3')