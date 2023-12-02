VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "clsTestDay01"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
Option Explicit
Implements ITestCaseSource

Private Const INPUT_FILENAME As String = "Day01"

Private Sub ITestCaseSource_GetTestCases(ByVal Test As SimplyVBComp.TestCaseCollector)
    Select Case Test.MethodName
        Case "Day01_Part1"
            Test.Use("test01").Expect 142
            Test.Use("input01").Expect 54081
        Case "Day01_Part2"
            Test.Use("test01").Expect 142
            Test.Use("input01").Expect 54649
        Case "GetBasicCalibrationValueTest"
            Test.Use("123").Expect 13
            Test.Use("a4b").Expect 44
        Case "GetAdvancedCalibrationValueTest"
            Test.Use("twone").Expect 21
    End Select
End Sub

Public Function Day01_Part1(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.clsDay01

    FileContents = basUtils.ReadFile(InputFilename)
    Day01_Part1 = Day.ExecutePartOne(FileContents)
End Function

Public Function Day01_Part2(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.clsDay01

    FileContents = basUtils.ReadFile(InputFilename)
    Day01_Part2 = Day.ExecutePartTwo(FileContents)
End Function

Public Sub Day01_Part2_OtherTest()
    Dim TestInput(0 To 6) As String
    TestInput(0) = "two1nine"
    TestInput(1) = "eightwothree"
    TestInput(2) = "abcone2threexyz"
    TestInput(3) = "xtwone3four"
    TestInput(4) = "4nineeightseven2"
    TestInput(5) = "zoneight234"
    TestInput(6) = "7pqrstsixteen"

    Dim Day As New AdventOfCode.clsDay01
    Assert.That Day.ExecutePartTwo(TestInput), Iz.EqualTo(281)
End Sub

Public Function GetBasicCalibrationValueTest(ByVal MyString As String) As Long
    Dim Day As New AdventOfCode.clsDay01
    GetBasicCalibrationValueTest = Day.GetBasicCalibrationValue(MyString)
End Function

Public Function GetAdvancedCalibrationValueTest(ByVal MyString As String) As Long
    Dim Day As New AdventOfCode.clsDay01
    GetAdvancedCalibrationValueTest = Day.GetAdvancedCalibrationValue(MyString)
End Function
