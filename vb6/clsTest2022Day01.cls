VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "clsTest2022Day01"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
Option Explicit
Implements ITestCaseSource

Private Sub ITestCaseSource_GetTestCases(ByVal Test As SimplyVBComp.TestCaseCollector)
    Select Case Test.MethodName
        Case "Day01_Part1"
            Test.Use("2022_01_test").Expect 24000
            Test.Use("2022_01_input").Expect 69281
        Case "Day01_Part2"
            Test.Use("2022_01_test").Expect 45000
            Test.Use("2022_01_input").Expect 201524
    End Select
End Sub

Public Function Day01_Part1(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.cls2022Day01

    FileContents = basUtils.ReadFile(InputFilename)
    Day01_Part1 = Day.ExecutePartOne(FileContents)
End Function

Public Function Day01_Part2(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.cls2022Day01

    FileContents = basUtils.ReadFile(InputFilename)
    Day01_Part2 = Day.ExecutePartTwo(FileContents)
End Function
