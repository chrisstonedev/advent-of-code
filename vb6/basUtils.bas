Attribute VB_Name = "basUtils"
Option Explicit

Public Function ReadFile(ByVal strFilename) As String()

    Dim someFileHandle As Integer
    Dim fileName As String
    Dim someStrings() As String

    someFileHandle = FreeFile

    fileName = App.Path + "\..\..\aoc-data\" + strFilename + ".txt"

    ReDim someStrings(5000) As String

    Open fileName For Input As #someFileHandle

    Dim lineNo As Integer

    Do Until EOF(someFileHandle)
        Line Input #someFileHandle, someStrings(lineNo)
        lineNo = lineNo + 1
    Loop

    ReDim Preserve someStrings(lineNo - 1) As String
 
    ReadFile = someStrings

End Function
