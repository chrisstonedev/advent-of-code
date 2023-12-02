VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "clsDay02"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = True
Option Explicit

Public Function ExecutePartOne(ByRef inputArray() As String) As Long
    Dim Value As Long

    Dim Index As Long
    For Index = 0 To UBound(inputArray)
        Dim SplitLine() As String
        Dim GameId As Long
        Dim DiceRollSets() As String
        Dim DiceRollsAreValid As Boolean

        SplitLine = Split(inputArray(Index), ": ")
        GameId = CLng(Split(SplitLine(0), " ")(1))
        DiceRollSets = Split(SplitLine(1), "; ")

        If CheckIfDiceRollsAreValid(DiceRollSets) Then
            Value = Value + GameId
        End If
    Next

    ExecutePartOne = Value
End Function

Public Function ExecutePartTwo(ByRef inputArray() As String) As Long
    Dim Value As Long

    Dim Index As Long
    For Index = 0 To UBound(inputArray)
        Dim SplitLine() As String
        Dim GameId As Long
        Dim DiceRollSets() As String
        Dim DiceRollsAreValid As Boolean

        SplitLine = Split(inputArray(Index), ": ")
        GameId = CLng(Split(SplitLine(0), " ")(1))
        DiceRollSets = Split(SplitLine(1), "; ")

        Value = Value + GetPowerOfDiceRolls(DiceRollSets)
    Next

    ExecutePartTwo = Value
End Function

Public Function CheckIfDiceRollsAreValid(ByRef DiceRollSets() As String) As Boolean
    Dim DiceRollSetIndex As Long
    For DiceRollSetIndex = 0 To UBound(DiceRollSets)
        Dim DiceRollsPerColor() As String
        DiceRollsPerColor = Split(DiceRollSets(DiceRollSetIndex), ", ")

        Dim DiceRollsPerColorIndex As Long
        For DiceRollsPerColorIndex = 0 To UBound(DiceRollsPerColor)
            Dim DiceRolled As Long
            Dim DiceColor As String

            DiceRolled = CLng(Split(DiceRollsPerColor(DiceRollsPerColorIndex), " ")(0))
            DiceColor = Split(DiceRollsPerColor(DiceRollsPerColorIndex), " ")(1)

            If (DiceColor = "red" And DiceRolled > 12) Or (DiceColor = "green" And DiceRolled > 13) Or (DiceColor = "blue" And DiceRolled > 14) Then
                Exit Function
            End If
        Next
    Next

    CheckIfDiceRollsAreValid = True
End Function

Public Function GetPowerOfDiceRolls(ByRef DiceRollSets() As String) As Long
    Dim RequiredRedDice As Long
    Dim RequiredGreenDice As Long
    Dim RequiredBlueDice As Long

    Dim DiceRollSetIndex As Long
    For DiceRollSetIndex = 0 To UBound(DiceRollSets)
        Dim DiceRollsPerColor() As String
        DiceRollsPerColor = Split(DiceRollSets(DiceRollSetIndex), ", ")

        Dim DiceRollsPerColorIndex As Long
        For DiceRollsPerColorIndex = 0 To UBound(DiceRollsPerColor)
            Dim DiceRolled As Long
            Dim DiceColor As String

            DiceRolled = CLng(Split(DiceRollsPerColor(DiceRollsPerColorIndex), " ")(0))
            DiceColor = Split(DiceRollsPerColor(DiceRollsPerColorIndex), " ")(1)

            If DiceColor = "red" Then
                RequiredRedDice = IIf(DiceRolled > RequiredRedDice, DiceRolled, RequiredRedDice)
            ElseIf DiceColor = "green" Then
                RequiredGreenDice = IIf(DiceRolled > RequiredGreenDice, DiceRolled, RequiredGreenDice)
            ElseIf DiceColor = "blue" Then
                RequiredBlueDice = IIf(DiceRolled > RequiredBlueDice, DiceRolled, RequiredBlueDice)
            End If
        Next
    Next

    GetPowerOfDiceRolls = RequiredRedDice * RequiredGreenDice * RequiredBlueDice
End Function
