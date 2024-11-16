VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "clsTest2023Day02"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = False
Option Explicit
Implements ITestCaseSource

Private Sub ITestCaseSource_GetTestCases(ByVal Test As SimplyVBComp.TestCaseCollector)
    Select Case Test.MethodName
        Case "Day02_Part1"
            Test.Use("2023_02_test").Expect 8
            Test.Use("2023_02_input").Expect 2156
        Case "Day02_Part2"
            Test.Use("2023_02_test").Expect 2286
            Test.Use("2023_02_input").Expect 66909
        Case "CheckIfDiceRollsAreValidTest"
            Test.Use("3 blue, 4 red", "1 red, 2 green, 6 blue", "2 green").Expect True
            Test.Use("1 blue, 2 green", "3 green, 4 blue, 1 red", "1 green, 1 blue").Expect True
            Test.Use("8 green, 6 blue, 20 red", "5 blue, 4 red, 13 green", "5 green, 1 red").Expect False
            Test.Use("1 green, 3 red, 6 blue", "3 green, 6 red", "3 green, 15 blue, 14 red").Expect False
        Case "CheckIfDiceRollsAreValidTest"
            Test.Use("3 blue, 4 red", "1 red, 2 green, 6 blue", "2 green").Expect True
            Test.Use("1 blue, 2 green", "3 green, 4 blue, 1 red", "1 green, 1 blue").Expect True
            Test.Use("8 green, 6 blue, 20 red", "5 blue, 4 red, 13 green", "5 green, 1 red").Expect False
            Test.Use("1 green, 3 red, 6 blue", "3 green, 6 red", "3 green, 15 blue, 14 red").Expect False
            Test.Use("6 red, 1 blue, 3 green", "2 blue, 1 red, 2 green").Expect True
        Case "GetPowerOfDiceRollsTest"
            Test.Use("3 blue, 4 red", "1 red, 2 green, 6 blue", "2 green").Expect 48
            Test.Use("1 blue, 2 green", "3 green, 4 blue, 1 red", "1 green, 1 blue").Expect 12
            Test.Use("8 green, 6 blue, 20 red", "5 blue, 4 red, 13 green", "5 green, 1 red").Expect 1560
            Test.Use("1 green, 3 red, 6 blue", "3 green, 6 red", "3 green, 15 blue, 14 red").Expect 630
            Test.Use("6 red, 1 blue, 3 green", "2 blue, 1 red, 2 green").Expect 36
    End Select
End Sub

Public Function Day02_Part1(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.cls2023Day02

    FileContents = basUtils.ReadFile(InputFilename)
    Day02_Part1 = Day.ExecutePartOne(FileContents)
End Function

Public Function Day02_Part2(ByVal InputFilename As String) As Long
    Dim FileContents() As String
    Dim Day As New AdventOfCode.cls2023Day02

    FileContents = basUtils.ReadFile(InputFilename)
    Day02_Part2 = Day.ExecutePartTwo(FileContents)
End Function

Public Function CheckIfDiceRollsAreValidTest(ByVal DiceRoll1 As String, ByVal DiceRoll2 As String, Optional ByVal DiceRoll3 As String = "")
    Dim TestInput() As String
    ReDim TestInput(1)
    TestInput(0) = DiceRoll1
    TestInput(1) = DiceRoll2
    If Len(DiceRoll3) > 0 Then
        ReDim Preserve TestInput(2)
        TestInput(2) = DiceRoll3
    End If

    Dim Day As New AdventOfCode.cls2023Day02
    CheckIfDiceRollsAreValidTest = Day.CheckIfDiceRollsAreValid(TestInput)
End Function

Public Function GetPowerOfDiceRollsTest(ByVal DiceRoll1 As String, ByVal DiceRoll2 As String, Optional ByVal DiceRoll3 As String = "")
    Dim TestInput() As String
    ReDim TestInput(1)
    TestInput(0) = DiceRoll1
    TestInput(1) = DiceRoll2
    If Len(DiceRoll3) > 0 Then
        ReDim Preserve TestInput(2)
        TestInput(2) = DiceRoll3
    End If

    Dim Day As New AdventOfCode.cls2023Day02
    GetPowerOfDiceRollsTest = Day.GetPowerOfDiceRolls(TestInput)
End Function
