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

Private Const INPUT_FILENAME As String = "Day01"

Public Sub Day01_PartOne_TestInput()
    Dim fileContents() As String
    Dim Something As New AdventOfCode2022.clsDay01
    Dim Actual As Long

    fileContents = basUtils.ReadFile(INPUT_FILENAME + "_test")
    Actual = Something.ExecutePartOne(fileContents)
    Assert.That Actual, Iz.EqualTo(24000)
End Sub

Public Sub Day01_PartOne_RealInput()
    Dim fileContents() As String
    Dim Something As New AdventOfCode2022.clsDay01
    Dim Actual As Long

    fileContents = basUtils.ReadFile(INPUT_FILENAME)
    Actual = Something.ExecutePartOne(fileContents)
    Assert.That Actual, Iz.EqualTo(69281)
End Sub

Public Sub Day01_PartTwo_TestInput()
    Dim fileContents() As String
    Dim Something As New AdventOfCode2022.clsDay01
    Dim Actual As Long

    fileContents = basUtils.ReadFile(INPUT_FILENAME + "_test")
    Actual = Something.ExecutePartTwo(fileContents)
    Assert.That Actual, Iz.EqualTo(45000)
End Sub

Public Sub Day01_PartTwo_RealInput()
    Dim fileContents() As String
    Dim Something As New AdventOfCode2022.clsDay01
    Dim Actual As Long

    fileContents = basUtils.ReadFile(INPUT_FILENAME)
    Actual = Something.ExecutePartTwo(fileContents)
    Assert.That Actual, Iz.EqualTo(201524)
End Sub

